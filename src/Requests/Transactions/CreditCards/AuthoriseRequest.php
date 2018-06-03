<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Transactions\CreditCards;

use EoneoPay\PhpSdk\Abstracts\Requests\Transactions\AbstractCreditCardRequest;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AuthoriseRequest extends AbstractCreditCardRequest implements RequestObjectInterface
{
    /**
     * @Assert\NotBlank(groups={"update"})
     * @Assert\Type(type="string", groups={"update"})
     *
     * @var string
     */
    protected $originalTransactionId;

    /**
     * Get original transaction id.
     *
     * @return null|string
     */
    public function getOriginalTransactionId(): ?string
    {
        return $this->originalTransactionId;
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
            self::CREATE => $this->url('authorise'),
            self::UPDATE => $this->url(\sprintf('authorise/%s', $this->getOriginalTransactionId()))
        ];
    }
}
