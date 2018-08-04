<?php
//phpcs:disable
namespace TwigWp\Tests\Unit\Module;

use TwigWp\Module\Escapers;
use TwigWp\Tests\TestCase;

class EscapersTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(Escapers::class, new Escapers([]));
    }

    public function testSetup()
    {
        $twigMock = \Mockery::mock('\\Twig\\Environment');

        $twigMock
            ->shouldReceive('addFilter')
            ->times(1);

        $twigMock
            ->shouldReceive('addFunction')
            ->times(1);

        $escapers = new Escapers([
            'esc_html__' => 'esc_html__',
        ]);
        $escapers->injectInto($twigMock);

        $this->assertTrue(true);
    }
}
