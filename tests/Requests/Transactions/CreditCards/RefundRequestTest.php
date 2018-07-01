<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Payloads\Gateway;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\AuthoriseRequest;
use EoneoPay\PhpSdk\Requests\Transactions\CreditCards\RefundRequest;
use EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class RefundRequestTest extends RequestTestCase
{
    /**
     * Test a successful refund request.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testSuccessfulRefundRequest(): void
    {
        $authorise = new AuthoriseRequest([
            'credit_card' => new CreditCard([
                'cvc' => '123',
                'expiry' => new Expiry(['month' => '12', 'year' => '2019']),
                'name' => 'Julian',
                'number' => '5123450000000008'
            ]),
            'id' => (string)\time(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => '10',
            'currency' => 'AUD',
            'reference' => 'julian test'
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->create($authorise);

        self::assertInstanceOf(TransactionResponse::class, $response);
        self::assertSame('10.00', $response->getAmount());
        self::assertSame('AUD', $response->getCurrency());

        $capture = new AuthoriseRequest([
            'original_id' => $response->getId(),
            'id' => (string)\time(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => $response->getAmount(),
            'currency' => $response->getCurrency()
        ]);

        $response = $this->client->update($capture);

        $refund = new RefundRequest([
            'original_id' => $response->getId(),
            'id' => (string)\time(),
            'gateway' => new Gateway(['service' => 'default', 'line_of_business' => 'eWallet']),
            'amount' => $response->getAmount(),
            'currency' => $response->getCurrency(),
        ]);

        /** @var \EoneoPay\PhpSdk\Responses\Transactions\TransactionResponse $response */
        $response = $this->client->delete($refund);

        self::assertSame('10.00', $response->getAmount());
        self::assertSame('AUD', $response->getCurrency());
        self::assertNotNull($response->getRequestId());
        self::assertSame(16, $response->getStatus());
    }
}
