<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2;

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
 *     "bank_account" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\BankAccount",
 *     "bpay" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Bpay",
 *     "credit_card" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\CreditCard",
 *     "ewallet" = "EoneoPay\PhpSdk\Endpoints\V2\PaymentSources\Ewallet"
 * })
 *
 * @Repository(repositoryClass="EoneoPay\PhpSdk\Repositories\PaymentSourceRepository")
 */
class PaymentSource extends Entity implements PaymentSourceInterface
{
    use PaymentSourceTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        // use V1 payment source endpoint to create/delete/get
        return [];
    }
}
