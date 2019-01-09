<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Tokenise;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Users\EndpointTokens\BankAccountToken;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestSerializationGroupAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestValidationGroupAwareInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class BankAccountRequest extends AbstractRequest implements
    RequestSerializationGroupAwareInterface,
    RequestValidationGroupAwareInterface
{
    /**
     * @Assert\NotBlank(groups={"tokenise"})
     * @Assert\Valid(groups={"tokenise"})
     *
     * @Groups({"tokenise"})
     *
     * @var \EoneoPay\PhpSdk\Requests\Payloads\BankAccount
     */
    protected $bankAccount;

    /**
     * @inheritdoc
     */
    public function expectObject(): string
    {
        return BankAccountToken::class;
    }

    /**
     * @inheritdoc
     */
    public function serializationGroup(): array
    {
        return [self::CREATE => ['tokenise']];
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/tokenise'
        ];
    }

    /**
     * @inheritdoc
     */
    public function validationGroups(): array
    {
        return [self::CREATE => ['tokenise']];
    }
}
