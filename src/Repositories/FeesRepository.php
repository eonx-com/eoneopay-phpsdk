<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Repositories;

use EoneoPay\PhpSdk\Endpoints\Fees;
use EoneoPay\PhpSdk\Endpoints\Transaction;
use EoneoPay\PhpSdk\Repository;

class FeesRepository extends Repository
{
    /**
     * Calculate the fees of the given context
     *
     * @param string $apiKey
     * @param \EoneoPay\PhpSdk\Endpoints\Transaction $transaction
     *
     * @return \EoneoPay\PhpSdk\Endpoints\Fees
     */
    public function calculateFees(
        string $apiKey,
        Transaction $transaction
    ): Fees {
        $fee = $this->getApiManager()->create(
            $apiKey,
            new Fees(\array_filter([
                'action' => $transaction->getAction(),
                'amount' => $transaction->getAmount(),
                'paymentDestination' => $transaction->getPaymentDestination(),
                'paymentSource' => $transaction->getPaymentSource()
            ]))
        );

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\Fees $fee
         *
         * @see https://youtrack.jetbrains.com/issue/WI-37859 typehint required until PhpStorm recognises ===
         */
        return ($fee instanceof Fees) ? $fee : new Fees();
    }
}
