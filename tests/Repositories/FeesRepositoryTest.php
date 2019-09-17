<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Repositories;

use EoneoPay\PhpSdk\Endpoints\Fees;
use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Repositories\FeesRepository;
use Tests\EoneoPay\PhpSdk\Stubs\Managers\EoneoPayApiManagerStub;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Repositories\FeesRepository
 */
final class FeesRepositoryTest extends TestCase
{
    /**
     * Data provider for input used for calculating fees from transaction.
     *
     * @return iterable|mixed[]
     */
    public function getInputCalculating(): iterable
    {
        yield 'Empty input, empty output' => [
            'transaction' => new Transaction(),
            'expectedFees' => new Fees(),
        ];

        yield 'Nulled values removed' => [
            'transaction' => new Transaction(['paymentDestination' => null, 'paymentSource' => null]),
            'expectedFees' => new Fees(),
        ];
    }

    /**
     * Test the calculation of fees repository passthrough.
     *
     * @param \EoneoPay\PhpSdk\Endpoints\Transaction $transaction
     * @param \EoneoPay\PhpSdk\Endpoints\Fees $expectedFee
     *
     * @return void
     *
     * @dataProvider getInputCalculating()
     */
    public function testCalculatingFees(Transaction $transaction, Fees $expectedFee): void
    {
        $repository = $this->getInstance();

        $fees = $repository->calculateFees('api-key', $transaction);

        self::assertEquals(
            $expectedFee,
            $fees
        );
    }

    /**
     * Instantiate an instance of the repository.
     *
     * @return \EoneoPay\PhpSdk\Repositories\FeesRepository
     */
    private function getInstance(): FeesRepository
    {
        return new FeesRepository(
            new EoneoPayApiManagerStub(),
            Fees::class
        );
    }
}
