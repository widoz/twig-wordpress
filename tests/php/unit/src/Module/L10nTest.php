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

namespace TwigWp\Tests\Unit\Module;

use TwigWp\Module\L10n;
use TwigWp\Tests\TestCase;

class L10nTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(L10n::class, new L10n([]));
    }

    public function testSetup()
    {
        $twigMock = \Mockery::mock('\\Twig\\Environment');

        $twigMock
            ->shouldReceive('addFunction')
            ->once();

        $kses = new L10n([
            'esc_html__' => 'esc_html__',
        ]);
        $kses->injectInto($twigMock);

        $this->assertTrue(true);
    }
}
