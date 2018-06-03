<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Endpoints;

use EoneoPay\PhpSdk\Requests\Endpoints\CreditCardRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class CreditCardRequestTest extends RequestTestCase
{
    public function testCreateSuccessfully(): void
    {
        $endpoint = new CreditCardRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ])
        ]);

        $response = $this->client->create($endpoint);

        self::assertInstanceOf(\EoneoPay\PhpSdk\Responses\Payloads\CreditCard::class, $response);

        \var_dump($response);
    }
}
