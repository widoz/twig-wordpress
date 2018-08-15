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

namespace TwigWp;

use TwigWp\Module\Provider;

/**
 * Class Factory
 *
 * @since   1.0.0
 * @package TwigWp
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
class Factory
{
    /**
     * Twig Loader
     *
     * @since 1.0.0
     *
     * @var \Twig\Loader\LoaderInterface A Twig Loader instance
     */
    private $loader;

    /**
     * Twig Environment Options
     *
     * @since 1.0.0
     *
     * @var array The options for the Twig Environment
     */
    private $options;

    /**
     * Factory constructor
     *
     * @since 1.0.0
     *
     * @param \Twig\Loader\LoaderInterface $loader  A Twig Loader instance.
     * @param array                        $options The Twig Environment options.
     */
    public function __construct(\Twig\Loader\LoaderInterface $loader, array $options)
    {
        $this->loader = $loader;
        $this->options = $options;
    }

    /**
     * Create Instance of Twig Environment
     *
     * @since 1.0.0
     *
     * @return \Twig\Environment The new instance of the environment
     */
    public function create(): \Twig\Environment
    {
        $twig = new \Twig\Environment($this->loader, $this->options);
        $modules = (new Provider($twig))->modules();

        foreach ($modules as $module) {
            if (!$module instanceof Module\Injectable) {
                continue;
            }

            // Add the module into Twig.
            $module->injectInto($twig);
        }

        return $twig;
    }
}
