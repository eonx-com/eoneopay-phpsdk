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
     * @param string $apikey Api key
     * @param string $token Payment source token
     *
     * @return \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    public function findByToken(string $apikey, string $token): ?PaymentSource
    {
        $entity = $this->getApiManager()->findOneBy(PaymentSource::class, $apikey, \compact('token'));

        return ($entity instanceof PaymentSource) === true ? $entity : null;
    }
}
