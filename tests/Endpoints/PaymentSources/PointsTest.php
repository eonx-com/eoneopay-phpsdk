<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Points;
use EoneoPay\PhpSdk\Interfaces\Endpoints\PaymentSourceInterface;
use Tests\EoneoPay\PhpSdk\TestCase;

class PointsTest extends TestCase
{
    /**
     * Test point source endpoint.
     *
     * @return void
     */
    public function testPointsSource(): void
    {
        $points = new Points([
            'account_id' => '607154ec-cc97-11ea-aa99-0251a38af4ee',
            'external_id' => '68dbb4e1-0e4f-440c-b3b9-8675bff34e84',
            'provider_id' => '43789817-cb14-11ea-aa99-0251a38af4ee',
        ]);

        $actual = $this->createApiManager([
            'account_id' => '607154ec-cc97-11ea-aa99-0251a38af4ee',
            'created_at' => '2020-08-26T06:00:56Z',
            'external_id' => '68dbb4e1-0e4f-440c-b3b9-8675bff34e84',
            'id' => '6070253ad912c2e35cd25a0a696c0676',
            'name' => 'John Wick',
            'pan' => '607154...8af4ee',
            'provider_id' => '43789817-cb14-11ea-aa99-0251a38af4ee',
            'token' => '********',
            'type' => PaymentSourceInterface::SOURCE_POINTS,
            'updated_at' => '2020-08-26T06:0:56Z'
        ])->create('4UM78RDZW93B84UJ', $points);

        self::assertInstanceOf(Points::class, $actual);
    }
}
