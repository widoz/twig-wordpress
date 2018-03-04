<?php
/**
 * FactoryTest
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
 * @package   unprefix-twig-wordpress
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

namespace Unprefix\Twig\Tests\php\integration\src;

use Unprefix\Twig\Factory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testConstruct()
    {
        $sut = new Factory(new \Twig\Loader\FilesystemLoader('./'), []);

        $this->assertInstanceOf('\\Unprefix\\Twig\\Factory', $sut);
    }

    public function testCreate()
    {
        $sut = new Factory(new \Twig\Loader\FilesystemLoader('./'), []);

        $this->assertInstanceOf('Twig\\Environment', $sut->create());
    }
}
