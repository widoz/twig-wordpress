<?php
declare(strict_types=1);

/**
 * Twig Factory
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Unprefix\Twig
 * @copyright Copyright (c) 2018, Guido Scialfa
 * @license   GNU General Public License, version 2
 *
 * Copyright (C) 2018 Guido Scialfa <dev@guidoscialfa.com>
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

namespace Unprefix\Twig;

use Unprefix\Twig\Module\Provider;

/**
 * Class Factory
 *
 * @since   1.0.0
 * @package Unprefix\Twig
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
        $this->loader  = $loader;
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
        $twig    = new \Twig\Environment($this->loader, $this->options);
        $modules = (new Provider($twig))->modules();

        foreach ($modules as $module) {
            if (! $module instanceof Module\Injectable) {
                continue;
            }

            // Add the module into Twig.
            $module->injectInto($twig);
        }

        return $twig;
    }
}
