<?php
declare(strict_types=1);

/**
 * Escapers
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
 * Class Escapers
 *
 * @since   1.0.0
 * @package Unprefix\Twig\Module
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
class Escapers implements Injectable
{
    use Helper;

    /**
     * WordPress Escapers
     *
     * @since 1.0.0
     *
     * @var array The escapers functions list to add to twig
     */
    private $escapers;

    /**
     * Escapers constructor
     *
     * @since 1.0.0
     *
     * @param array $escapers The escapers functions list to add to twig.
     */
    public function __construct(array $escapers = [])
    {
        $this->escapers = $escapers;
    }

    /**
     * @inheritdoc
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment
    {
        $escapers = $this->escapers;

        if (function_exists('apply_filters')) {
            /**
             * Filter Escapers List to register
             *
             * @since 1.0.0
             *
             * @param array             $escapers The current escapers list.
             * @param \Twig\Environment $twig     The twig environment instance.
             */
            $escapers = apply_filters('unprefix_twig_escapers_list', $escapers, $twig);
        }

        foreach ($escapers as $key => $escaper) {
            // Looking for options.
            list($escaper, $options) = $this->extractConfiguration((array)$escaper);

            $twig->addFilter(new \Twig_Filter($key, $escaper, $options));
            $twig->addFunction(new \Twig\TwigFunction($key, $escaper, $options));
        }

        return $twig;
    }
}
