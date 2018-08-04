<?php
// phpcs:disable
namespace TwigWp\Tests\Unit;

use Twig\Loader\LoaderInterface;
use TwigWp\Factory;
use PHPUnit\Framework\TestCase;
use TwigWp\Module\Provider;
use TwigWp\Tests\Stubs\Classes\ModuleStub;

class FactoryTest extends TestCase
{
    public function testCreate()
    {
        $loaderMock = \Mockery::mock(LoaderInterface::class);
        $providerMock = \Mockery::mock('overload:' . Provider::class);

        $providerMock->shouldReceive('modules')
                     ->andReturn([]);

        $sut = new Factory($loaderMock, []);

        $response = $sut->create();

        $this->assertInstanceOf('Twig\\Environment', $response);
    }

    public function testCreateWithModules()
    {
        $loaderMock = \Mockery::mock(LoaderInterface::class);
        $providerMock = \Mockery::mock('overload:' . Provider::class);

        $providerMock->shouldReceive('modules')
                     ->andReturn([
                         new ModuleStub(),
                     ]);

        $sut = new Factory($loaderMock, []);

        $response = $sut->create();

        $this->assertInstanceOf('Twig\\Environment', $response);
    }

    public function setUp()
    {

        require_once TWIG_TESTS_DIR . '/php/_stubs/classes/ModuleStub.php';

        parent::setUp();
    }
}
