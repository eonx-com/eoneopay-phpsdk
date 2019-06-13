<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Annotations\Repository;
use EoneoPay\PhpSdk\Traits\FeesTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @Repository(repositoryClass="EoneoPay\PhpSdk\Repositories\PaymentSourceRepository")
 */
class Fees extends Entity
{
    use FeesTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/calculate/fees'
        ];
    }
}
