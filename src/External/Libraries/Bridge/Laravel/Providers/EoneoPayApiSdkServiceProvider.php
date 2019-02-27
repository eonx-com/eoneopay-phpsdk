<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers;

use EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers\Sdk\SdkManagerServiceProvider;
use EoneoPay\PhpSdk\Factories\ExceptionFactory;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\Factories\ExceptionFactoryInterface;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use Illuminate\Support\ServiceProvider;

class EoneoPayApiSdkServiceProvider extends ServiceProvider
{
    /**
     * Register services
     *
     * @return void
     */
    public function register(): void
    {
        // register sdk manager service provider
        $this->app->register(SdkManagerServiceProvider::class);

        // register EoneoPay api manager service
        $this->app->singleton(ExceptionFactoryInterface::class, ExceptionFactory::class);
        $this->app->singleton(EoneoPayApiManagerInterface::class, EoneoPayApiManager::class);
    }
}
