<?php
// phpcs:disable
namespace Unprefix\Twig\Tests\Unit;

use Unprefix\Twig\Factory;
use PHPUnit\Framework\TestCase;
use Unprefix\Twig\Tests\Stubs\Classes\ModuleStub;

class FactoryTest extends TestCase
{
    public function testCreate()
    {
        $loaderMock   = \Mockery::mock('Twig\\Loader\\LoaderInterface');
        $providerMock = \Mockery::mock('overload:Unprefix\\Twig\\Module\\Provider');

        $providerMock->shouldReceive('modules')
                     ->andReturn([]);

        $sut = new Factory($loaderMock, []);

        $response = $sut->create();

        $this->assertInstanceOf('Twig\\Environment', $response);
    }

    public function testCreateWithModules()
    {
        $loaderMock   = \Mockery::mock('Twig\\Loader\\LoaderInterface');
        $providerMock = \Mockery::mock('overload:Unprefix\\Twig\\Module\\Provider');

        $providerMock->shouldReceive('modules')
                     ->andReturn([
                         new ModuleStub(),
                     ]);

        $sut = new Factory($loaderMock, []);

        $response = $sut->create();

        $this->assertInstanceOf('Twig\\Environment', $response);
    }

    public function setUp() {

        require_once UNPREFIX_TWIG_TESTS_DIR. '/php/_stubs/classes/ModuleStub.php';

        parent::setUp();
    }
}
