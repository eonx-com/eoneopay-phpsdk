<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\External\Libraries\Bridge\Laravel\Providers;

use EoneoPay\PhpSdk\Factories\ExceptionFactory;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use GuzzleHttp\Client;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\SerializerFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Factories\UrnFactory;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\RequestHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Handlers\ResponseHandler;
use LoyaltyCorp\SdkBlueprint\Sdk\Managers\SdkManager;

class EoneoPayApiSdkServiceProvider extends ServiceProvider
{
    /**
     * Register services
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('eoneopay_api_client', static function () {
            return new Client(['base_uri' => \env('EONEOPAY_API_BASE_URI')]);
        });

        $this->app->singleton(EoneoPayApiManagerInterface::class, static function (Container $application) {
            return new EoneoPayApiManager(
                new SdkManager(
                    new RequestHandler(
                        $application->make('eoneopay_api_client'),
                        new ResponseHandler(),
                        new SerializerFactory(),
                        new UrnFactory()
                    )
                ),
                new ExceptionFactory()
            );
        });
    }
}
