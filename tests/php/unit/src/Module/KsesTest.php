<?php
//phpcs:disable
namespace TwigWp\Tests\Unit\Module;

use TwigWp\Module\Kses;
use TwigWp\Tests\TestCase;

class KsesTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(Kses::class, new Kses([]));
    }

    public function testSetup()
    {
        $twigMock = \Mockery::mock('\\Twig\\Environment');

        $twigMock
            ->shouldReceive('addFunction')
            ->once();

        $kses = new Kses([
            'wp_kses' => 'wp_kses',
        ]);
        $kses->injectInto($twigMock);

        $this->assertTrue(true);
    }
}
