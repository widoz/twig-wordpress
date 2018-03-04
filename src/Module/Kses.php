<?php
declare(strict_types=1);

/**
 * Kses
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   Unprefix\Twig\Module
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

namespace Unprefix\Twig\Module;

/**
 * Class Kses
 *
 * @since   1.0.0
 * @package Unprefix\Twig\Module
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
class Kses implements Injectable
{
    use Helper;

    /**
     * Kses Functions list
     *
     * @since 1.0.0
     *
     * @var array The list of kses functions to register in twig
     */
    private $kses;

    /**
     * Kses constructor
     *
     * @since 1.0.0
     *
     * @param array $kses The list of kses functions to register into twig
     */
    public function __construct(array $kses = [])
    {
        $this->kses = $kses;
    }

    /**
     * @inheritdoc
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        $kses = $this->kses;

        if (function_exists('apply_filters')) {
            /**
             * Filter Kses List to register
             *
             * @since 1.0.0
             *
             * @param array             $kses The current kses list.
             * @param \Twig\Environment $twig The twig environment instance.
             */
            $kses = apply_filters('unprefix_twig_kses_list', $kses, $twig);
        }

        foreach ($kses as $key => $k) {
            // Looking for options.
            list($k, $options) = $this->extractConfiguration((array)$k);

            $twig->addFunction(new \Twig\TwigFunction($key, $k, $options));
        }

        return $twig;
    }
}
