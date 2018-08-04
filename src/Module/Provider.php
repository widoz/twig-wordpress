<?php
/**
 * This file is part of the Twig WordPress package.
 *
 * (c) Guido Scialfa <dev@guidoscialfa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TwigWp\Module;

/**
 * Class Provider
 */
class Provider
{
    /**
     * Twig Environment Instance
     *
     * @var \Twig\Environment The instance of twig environment
     */
    private $twig;

    /**
     * Modules Path
     *
     * The path where the modules are stored.
     *
     * @var string The path where the modules are stored
     */
    private $modulesPath;

    /**
     * Provider constructor
     *
     * @param \Twig\Environment $twig The instance of twig environment
     */
    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
        $this->modulesPath = dirname(dirname(__DIR__)) . '/inc';
    }

    /**
     * Retrieve modules
     *
     * @return array The modules list
     */
    public function modules(): array
    {
        $modules = [];

        foreach (glob(__DIR__ . '/*.php') as $module) {
            $className = basename($module, '.php');
            $class = __NAMESPACE__ . '\\' . $className;
            $config = $this->modulesPath . '/' . strtolower("{$className}.inc");
            $interfaces = class_implements($class);

            if (!in_array('TwigWp\Module\Injectable', $interfaces, true)) {
                continue;
            }

            if (file_exists($config)) {
                /** @noinspection PhpIncludeInspection */
                $config = require_once $config;
                $modules[$className] = new $class($config);
                continue;
            }

            $modules[$module] = new $class();
        }

        if (function_exists('apply_filters')) {
            /**
             * Filter Modules
             *
             * @since 1.0.0
             *
             * @param array $modules The registered modules.
             * @param \Twig\Environment $twig The Twig Environment Instance.
             */
            $modules = apply_filters('twigwp.modules', $modules, $this->twig);
        }

        return array_filter($modules);
    }
}
