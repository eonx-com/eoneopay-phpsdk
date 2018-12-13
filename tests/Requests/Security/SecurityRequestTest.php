<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Security;

use EoneoPay\PhpSdk\Requests\Payloads\Amount;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCards\Expiry;
use EoneoPay\PhpSdk\Requests\Security\SecurityRequest;
use EoneoPay\PhpSdk\Responses\Security;
use Exception;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException;
use Tests\EoneoPay\PhpSdk\TestCases\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Security\SecurityRequest
 */
class SecurityRequestTest extends RequestTestCase
{
    /**
     * Test security initiate successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testInitiateSuccessfully(): void
    {
        $request = new SecurityRequest([
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '100.00'
            ]),
            'credit_card' => new CreditCard([
                'cvc' => '100',
                'expiry' => new Expiry(['month' => '05', 'year' => '2021']),
                'name' => 'John Wick',
                'number' => '5123450000000008'
            ]),
            'id' => 'external-security-id',
            'return_url' => 'http://localhost'
        ]);

        $initiate = $this->createClient($this->getSecurityData())->create($request);

        self::assertInstanceOf(Security::class, $initiate);
        /** @var \EoneoPay\PhpSdk\Responses\Security $initiate */
        self::assertSame(
            'AUD',
            $initiate->getAmount() ? $initiate->getAmount()->getCurrency() : ''
        );
        self::assertSame(
            '100.00',
            $initiate->getAmount() ? $initiate->getAmount()->getTotal() : ''
        );
        self::assertSame('external-security-id', $initiate->getId());
        self::assertNotNull($initiate->getRequestPayload());
    }

    /**
     * Test initiating security with invalid data will throw exception.
     *
     * @return void
     */
    public function testInitiateValidationException(): void
    {
        $request = new SecurityRequest([
            'amount' => new Amount([
                'total' => '100.00'
            ]),
            'credit_card' => new CreditCard([
                'cvc' => '100',
                'name' => 'John Wick',
                'number' => '5123450000000008'
            ]),
            'id' => 'external-security-id',
            'return_url' => 'http://localhost'
        ]);

        try {
            $this->createClient($this->getSecurityData())->create($request);
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'amount.currency' => ['This value should not be blank.'],
                    'credit_card.expiry' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Test security verify successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testVerifySuccessfully(): void
    {
        $verify = $this->createClient($this->getSecurityData())->update(new SecurityRequest([
            'payload' => 'request-payload',
            'id' => 'external-security-id'
        ]));

        self::assertInstanceOf(Security::class, $verify);
        /** @var \EoneoPay\PhpSdk\Responses\Security $verify */
        self::assertNotNull($verify->getResponsePayload());
        self::assertSame(
            'AUD',
            $verify->getAmount() ? $verify->getAmount()->getCurrency() : ''
        );
        self::assertSame(
            '100.00',
            $verify->getAmount() ? $verify->getAmount()->getTotal() : ''
        );
        self::assertSame('external-security-id', $verify->getId());
    }

    /**
     * Test verifying security with invalid data will throw exception.
     *
     * @return void
     */
    public function testVerifyValidationException(): void
    {
        $request = new SecurityRequest([
            'id' => 'external-security-id'
        ]);

        try {
            $this->createClient($this->getSecurityData())->update($request);
        } catch (Exception $exception) {
            self::assertInstanceOf(ValidationException::class, $exception);

            $expected = [
                'violations' => [
                    'payload' => ['This value should not be blank.']
                ]
            ];

            /** @var \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\ValidationException $exception */
            self::assertSame($expected, $exception instanceof ValidationException ? $exception->getErrors() : []);
        }
    }

    /**
     * Get security data.
     *
     * @param mixed[]|null $data Security data.
     *
     * @return mixed[]
     */
    private function getSecurityData(?array $data = null): array
    {
        $data = $data ?? [];

        return \array_merge([
            'amount' => new Amount([
                'currency' => 'AUD',
                'total' => '100.00'
            ]),
            'cavv' => null,
            'id' => 'external-security-id',
            'request_payload' => 'request-payload',
            'response_payload' => 'response-payload',
            'return_url' => 'http://localhost',
            'secured' => false,
            'status' => 'completed',
            'xid' => 'test-xid'
        ], $data);
    }
}
