<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Annotations\Repository;
use EoneoPay\PhpSdk\Interfaces\Endpoints\PaymentSourceInterface;
use EoneoPay\PhpSdk\Traits\PaymentSourceTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @method string|null getCreatedAt()
 * @method string|null getId()
 * @method string|null getName()
 * @method string|null getPan()
 * @method string|null getToken()
 * @method string|null getType()
 * @method string|null getUpdatedAt()
 *
 * @DiscriminatorMap(typeProperty="type", mapping={
 *     "bank_account" = "EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount",
 *     "bpay" = "EoneoPay\PhpSdk\Endpoints\PaymentSources\Bpay",
 *     "credit_card" = "EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard",
 *     "ewallet" = "EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet"
 * })
 *
 * @Repository(repositoryClass="EoneoPay\PhpSdk\Repositories\PaymentSourceRepository")
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class PaymentSource extends Entity implements PaymentSourceInterface
{
    use PaymentSourceTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/tokens',
            self::DELETE => \sprintf('/tokens/%s', $this->getToken()),
            self::GET => \sprintf('/tokens/%s', $this->getToken()),
        ];
    }
}
