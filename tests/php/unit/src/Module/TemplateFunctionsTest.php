<?php
//phpcs:disable
namespace TwigWp\Tests\Unit\Module;

use TwigWp\Module\TemplateFunctions;
use TwigWp\Tests\TestCase;

class TemplateFunctionsTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf(TemplateFunctions::class, new TemplateFunctions([]));
    }

    public function testSetup()
    {
        $twigMock = \Mockery::mock('\\Twig\\Environment');

        $twigMock
            ->shouldReceive('addFunction')
            ->times(1);

        $escapers = new TemplateFunctions([
            'wp_nav_menu' => 'wp_nav_menu',
        ]);
        $escapers->injectInto($twigMock);

        $this->assertTrue(true);
    }
}
