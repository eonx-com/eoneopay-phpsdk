<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Users\ReferenceNumber;
use EoneoPay\PhpSdk\Traits\ReferenceNumberTrait;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class CrnRequest extends AbstractRequest
{
    use ReferenceNumberTrait;

    /**
     * Ewallet.
     *
     * @Assert\NotNull(groups={"create"})
     * @Assert\Valid(groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var null|\EoneoPay\PhpSdk\Requests\Payloads\Ewallet|\EoneoPay\PhpSdk\Requests\Payloads\Token
     */
    protected $ewallet;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return ReferenceNumber::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('users/%s/crn', $this->userId)
        ];
    }
}
