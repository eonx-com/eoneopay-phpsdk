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
     * @return \EoneoPay\PhpSdk\Endpoints\PaymentSource
     */
    public function findByToken(string $token, string $apikey): PaymentSource
    {
        return $this->getApiManager()->findOneBy(PaymentSource::class, $apikey, \compact('token'));
    }
}
