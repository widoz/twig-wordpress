<?php
/**
 * UnprefixTestCase
 *
 * @author    Guido Scialfa <dev@guidoscialfa.com>
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

namespace Unprefix\Twig\Tests;

use PHPUnit\Framework\TestCase;

class UnprefixTestCase extends TestCase
{
    protected static $sourcePath;

    protected function defineCommonWPFunctions()
    {

    }

    protected function setUp()
    {
        parent::setUp();
        \Brain\Monkey\setUp();
        self::defineCommonWPFunctions();
    }

    protected function tearDown()
    {
        \Brain\Monkey\tearDown();
        parent::tearDown();
    }

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        self::$sourcePath = dirname(dirname(__DIR__));
    }
}
