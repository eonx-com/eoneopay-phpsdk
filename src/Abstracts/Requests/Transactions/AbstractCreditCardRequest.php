<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Abstracts\Requests\Transactions;

use EoneoPay\PhpSdk\Abstracts\Requests\AbstractTransactionRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractCreditCardRequest extends AbstractTransactionRequest
{
    /**
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\CreditCard|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $creditCard;

    /**
     * Specify the expected returned object.
     *
     * @return string
     */
    public function expectObject(): ?string
    {
        return CreditCardTransactionResponse::class;
    }

    /**
     * Get credit_card.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }
}
