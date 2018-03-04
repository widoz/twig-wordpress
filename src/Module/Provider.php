<?php
declare(strict_types=1);

/**
 * Provider
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Unprefix\Twig\Module
 * @copyright Copyright (c) 2017, Guido Scialfa
 * @license   GNU General Public License, version 2
 *
 * Copyright (C) 2017 Guido Scialfa <dev@guidoscialfa.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace Unprefix\Twig\Module;

/**
 * Class Provider
 *
 * @since   1.0.0
 * @package Unprefix\Twig\Module
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
class Provider
{
    /**
     * Twig Environment Instance
     *
     * @since 1.0.0
     *
     * @var \Twig\Environment The instance of twig environment
     */
    private $twig;

    /**
     * Modules Path
     *
     * The path where the modules are stored.
     *
     * @since 1.0.0
     *
     * @var string The path where the modules are stored
     */
    private $modulesPath;

    /**
     * Provider constructor
     *
     * @since 1.0.0
     *
     * @param \Twig\Environment $twig The instance of twig environment
     */
    public function __construct(\Twig\Environment $twig)
    {
        $this->twig        = $twig;
        $this->modulesPath = dirname(dirname(__DIR__)) . '/inc';
    }

    /**
     * Retrieve modules
     *
     * @since 1.0.0
     *
     * @return array The modules list
     */
    public function modules(): array
    {
        $modules = [];

        foreach (glob(__DIR__ . '/*.php') as $module) {
            $className  = basename($module, '.php');
            $class      = __NAMESPACE__ . '\\' . $className;
            $config     = $this->modulesPath . '/' . strtolower("{$className}.inc");
            $interfaces = class_implements($class);

            if (! in_array('Unprefix\Twig\Module\Injectable', $interfaces, true)) {
                continue;
            }

            if (file_exists($config)) {
                $config              = require_once $config;
                $modules[$className] = new $class($config);
                break;
            }

            $modules[$module] = new $class();
        }

        if (function_exists('apply_filters')) {
            /**
             * Filter Modules
             *
             * @since 1.0.0
             *
             * @param array             $modules The registered modules.
             * @param \Twig\Environment $twig    The Twig Environment Instance.
             */
            $modules = apply_filters('unprefix_twig_modules', $modules, $this->twig);
        }

        return array_filter($modules);
    }
}
