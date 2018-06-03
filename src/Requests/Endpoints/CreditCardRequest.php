<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Endpoints;

use EoneoPay\PhpSdk\Abstracts\Requests\Endpoints\AbstractCreateEndpointRequest;
use EoneoPay\PhpSdk\Requests\Payloads\CreditCard;
use EoneoPay\PhpSdk\Responses\Payloads\CreditCard as CreditCardResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CreditCardRequest extends AbstractCreateEndpointRequest implements RequestObjectInterface
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
     * Get credit_card.
     *
     * @return null|\EoneoPay\PhpSdk\Requests\Payloads\CreditCard
     */
    public function getCreditCard(): ?CreditCard
    {
        return $this->creditCard;
    }

    /**
     * Specify the expected returned object.
     *
     * @return string
     */
    public function expectObject(): ?string
    {
        return CreditCardResponse::class;
    }
}
