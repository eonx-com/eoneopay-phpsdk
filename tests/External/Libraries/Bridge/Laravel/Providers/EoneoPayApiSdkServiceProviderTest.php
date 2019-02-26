<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers;

use EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers\EoneoPayApiSdkServiceProvider;
use GuzzleHttp\Client;
use Laravel\Lumen\Application;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\RequestHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\Handlers\RequestHandlerInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Managers\SdkManager;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers\EoneoPayApiSdkServiceProvider
 */
class EoneoPayApiSdkServiceProviderTest extends TestCase
{
    /**
     * @var \Laravel\Lumen\Application
     */
    private $app;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->app = new Application();
        $this->app->register(EoneoPayApiSdkServiceProvider::class);
        $this->app->singleton('eoneopay_api_client', function () {
            return new Client();
        });
    }

    /**
     * Test provider registers bindings as expected
     *
     * @return void
     */
    public function testServiceProviderRegistersBindingsInContainer(): void
    {
        self::assertInstanceOf(
            RequestHandler::class,
            $this->app->make(RequestHandlerInterface::class)
        );
        self::assertInstanceOf(
            SdkManager::class,
            $this->app->make(SdkManagerInterface::class)
        );
    }
}
