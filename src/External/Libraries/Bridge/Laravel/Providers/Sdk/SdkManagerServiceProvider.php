<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers\Sdk;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\SerializerFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\UrnFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\RequestHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\ResponseHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\Handlers\RequestHandlerInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Managers\SdkManager;

class SdkManagerServiceProvider extends ServiceProvider
{
    /**
     * Register sdk manager services
     *
     * @return void
     */
    public function register(): void
    {
        // bind handlers
        $this->app->singleton(RequestHandlerInterface::class, function (Application $app) {
            return new RequestHandler(
                $app->make('eoneopay_api_client'),
                new ResponseHandler(),
                new SerializerFactory(),
                new UrnFactory()
            );
        });

        // bind manager
        $this->app->singleton(SdkManagerInterface::class, SdkManager::class);
    }
}
