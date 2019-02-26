<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Annotations\Repository;
use EoneoPay\PhpSdk\Interfaces\Endpoints\PaymentSourceInterface;
use EoneoPay\PhpSdk\Traits\PaymentSourceTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @method string|null getToken()
 * @method string|null getPan()
 * @method string|null getType()
 *
 * @DiscriminatorMap(typeProperty="type", mapping={
 *     "bank_account"="EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount",
 *     "credit_card"="EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard",
 *     "ewallet"="EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet"
 * })
 *
 * @Repository(repositoryClass="EoneoPay\PhpSdk\Repositories\PaymentSourceRepository")
 */
class PaymentSource extends Entity implements PaymentSourceInterface
{
    use PaymentSourceTrait;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('http://localhost/tokens/%s', $this->token)
        ];
    }
}
