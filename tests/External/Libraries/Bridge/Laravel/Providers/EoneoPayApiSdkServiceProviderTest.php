<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers;

use EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers\EoneoPayApiSdkServiceProvider;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use GuzzleHttp\Client;
use Laravel\Lumen\Application;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers\EoneoPayApiSdkServiceProvider
 */
final class EoneoPayApiSdkServiceProviderTest extends TestCase
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
    }

    /**
     * Test provider registers bindings as expected.
     *
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testServiceProviderRegistersBindingsInContainer(): void
    {
        self::assertInstanceOf(Client::class, $this->app->make('eoneopay_api_client'));
        self::assertInstanceOf(
            EoneoPayApiManager::class,
            $this->app->make(EoneoPayApiManagerInterface::class)
        );
    }
}
