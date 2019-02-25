<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\PaymentSourceTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Annotations\Repository;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;

/**
 * @DiscriminatorMap(typeProperty="type", mapping={
 *     "bank_account"="EoneoPay\PhpSdk\Endpoints\PaymentSources\BankAccount",
 *     "credit_card"="EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard",
 *     "ewallet"="EoneoPay\PhpSdk\Endpoints\PaymentSources\Ewallet"
 * })
 *
 * @Repository(repositoryClass="EoneoPay\PhpSdk\Repositories\PaymentSourceRepository")
 */
class PaymentSource extends Entity
{
    use PaymentSourceTrait;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('http://payments.box/tokens/%s', $this->token)
        ];
    }
}
