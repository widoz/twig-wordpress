<?php
declare(strict_types=1);

/**
 * Injectable Interface
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
 * Interface Module
 *
 * @since   1.0.0
 * @package Unprefix\Twig\Module
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 */
interface Injectable
{
    /**
     * Inject Module into Twig
     *
     * @since 1.0.0
     *
     * @param \Twig\Environment $twig The Twig instance.
     *
     * @return \Twig\Environment The instance of twig environment class
     */
    public function injectInto(\Twig\Environment $twig): \Twig\Environment;
}
