<?php
//phpcs:disable
namespace Unprefix\Twig\Tests\Unit\Module;

use Unprefix\Twig\Module\Escapers;
use Unprefix\Twig\Tests\UnprefixTestCase;

class EscapersTest extends UnprefixTestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf('\\Unprefix\\Twig\\Module\\Escapers', new Escapers([]));
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
