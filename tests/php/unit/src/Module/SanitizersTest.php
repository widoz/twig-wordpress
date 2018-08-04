<?php
/**
 * This file is part of the Twig WordPress package.
 *
 * (c) Guido Scialfa <dev@guidoscialfa.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigWp\Tests\Unit\Module;

use TwigWp\Module\Sanitizers;
use TwigWp\Tests\TestCase;

class SanitizersTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(Sanitizers::class, new Sanitizers([]));
    }

    public function testSetup()
    {
        $twigMock = \Mockery::mock('\\Twig\\Environment');

        $twigMock
            ->shouldReceive('addFunction')
            ->times(1);

        $escapers = new Sanitizers([
            'sanitize_html_class' => 'sanitize_html_class',
        ]);
        $escapers->injectInto($twigMock);

        $this->assertTrue(true);
    }
}
