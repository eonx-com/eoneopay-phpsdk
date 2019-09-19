<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Annotations\Repository;
use EoneoPay\PhpSdk\Traits\FeesTrait;
use EoneoPay\PhpSdk\ValueTypes\Amount;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAction()
 * @method Amount|null getAmount()
 * @method PaymentSource|null getPaymentDestination()
 * @method PaymentSource|null getPaymentSource()
 *
 * @Repository(repositoryClass="EoneoPay\PhpSdk\Repositories\FeesRepository")
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
            self::CREATE => '/calculate/fees',
        ];
    }
}
