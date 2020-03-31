<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers;

use EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers\EoneoPayApiSdkServiceProvider;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\EoneoPayV2ApiManagerInterface;
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
     * Test provider registers bindings as expected.
     *
     * @return void
     */
    public function testServiceProviderRegistersBindingsInContainer(): void
    {
        self::assertInstanceOf(Client::class, $this->app->make('eoneopay_api_client'));
        self::assertInstanceOf(
            EoneoPayApiManager::class,
            $this->app->make(EoneoPayApiManagerInterface::class)
        );

    }

    /**
     * Tests v2 service binding.
     *
     * @return void
     */
    public function testV2ClientServiceBindings(): void
    {
        $clientV2 = $this->app->make('eoneopay_v2_api_client');
        $v2Manager = $this->app->make(EoneoPayV2ApiManagerInterface::class);
        self::assertInstanceOf(Client::class, $clientV2);
        /**
         * @var \GuzzleHttp\Client $clientV2
         */
        self::assertSame('application/vnd.eoneopay.v2+json', $clientV2->getConfig('headers')['Accept']);
        self::assertInstanceOf(EoneoPayApiManager::class, $v2Manager);
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app = new Application();
        $this->app->register(EoneoPayApiSdkServiceProvider::class);
    }
}
