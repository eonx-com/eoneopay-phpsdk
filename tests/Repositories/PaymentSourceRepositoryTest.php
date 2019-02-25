<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Repositories;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount;
use EoneoPay\PhpSdk\Exceptions\ClientException;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Repositories\PaymentSourceRepository
 */
class PaymentSourceRepositoryTest extends TestCase
{
    /**
     * Test a exception is thrown when a invalid token is sent through
     *
     * @return void
     */
    public function testExceptionThrownOnNotValidToken(): void
    {
        $this->expectException(ClientException::class);
        $repository = $this->createApiManager(
            [
                'code' => 4701,
                'message' => 'Token provided is invalid or not found.',
                'sub_code' => 1
            ],
            404
        )->getRepository(BankAccount::class);
        $repository->findByToken('invalid_token_sent', (string)\getenv('PAYMENTS_API_KEY'));
    }

    /**
     * Test Valid payment source is returned
     *
     * @return void
     */
    public function testValidPaymentSourceReturned(): void
    {

        $repository = $this->createApiManager([
            'type' => 'ewallet'
        ])->getRepository(PaymentSource::class);

        $paymentSource = $repository->findByToken((string)\getenv('PAYMENTS_TOKEN_CREDIT_CARD'), (string)\getenv('PAYMENTS_API_KEY'));
        self::assertNotNull($paymentSource);
        self::assertInstanceOf(PaymentSource::class, $paymentSource);
    }
}
