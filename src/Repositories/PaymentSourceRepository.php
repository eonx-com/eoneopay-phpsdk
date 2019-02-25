<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Repositories;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Repository;

class PaymentSourceRepository extends Repository
{
    /**
     * Find payment source by token.
     *
     * @param string $token Payment source token
     * @param string $apikey Api key
     *
     * @return \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    public function findByToken(string $token, string $apikey): ?PaymentSource
    {
        $paymentSource = $this->getApiManager()->findOneBy(PaymentSource::class, $apikey, \compact('token'));

        if (($paymentSource instanceof PaymentSource) !== true) {
            return null;
        }

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource $paymentSource
         *
         * @see https://youtrack.jetbrains.com/issue/WI-37859 - typehint required until PhpStorm recognises === check
         */
        return $paymentSource;
    }
}
