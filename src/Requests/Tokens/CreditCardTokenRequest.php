<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Tokens;

use EoneoPay\PhpSdk\Abstracts\Requests\AbstractTokenRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Payloads\TokenisedBankAccount;
use EoneoPay\PhpSdk\Responses\Payloads\TokenisedCreditCard;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreditCardTokenRequest extends AbstractTokenRequest implements RequestObjectInterface
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\CreditCard
     */
    protected $creditCard;

    /**
     * Specify the expected returned object.
     *
     * @return string
     */
    public function expectObject(): ?string
    {
        return TokenisedCreditCard::class;
    }

    /**
     * Get credit_card.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard
     */
    public function getCreditCard(): ?CreditCard
    {
        return $this->creditCard;
    }
}
