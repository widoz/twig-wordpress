<?php
//phpcs:disable
namespace Unprefix\Twig\Tests\Unit\Module;

use Unprefix\Twig\Module\Kses;
use PHPUnit\Framework\TestCase;

class KsesTest extends TestCase
{
    public function testConstruct()
    {
        $this->assertInstanceOf('Unprefix\\Twig\\Module\\Kses', new Kses([]));
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
