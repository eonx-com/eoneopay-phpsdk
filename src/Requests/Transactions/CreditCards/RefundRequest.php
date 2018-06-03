<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Abstracts\Requests\AbstractTransactionRequest;
use EoneoPay\PhpSdk\Responses\Transactions\CreditCardTransactionResponse;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RefundRequest extends AbstractTransactionRequest implements RequestObjectInterface
{
    /**
     * @Assert\NotBlank(groups={"delete"})
     * @Assert\Type(type="string", groups={"delete"})
     *
     * @var string
     */
    protected $transactionId;

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
     * Get transaction id.
     *
     * @return null|string
     */
    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    /**
     * Don't prefix method with get or set as serializer will output the method name as attributes.
     *
     * Specify the request uri.
     *
     * @return array
     */
    public function uris(): array
    {
        return [
            self::DELETE => $this->url(\sprintf('transactions/%s', $this->getTransactionId()))
        ];
    }
}
