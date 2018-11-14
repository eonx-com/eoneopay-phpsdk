<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use EoneoPay\PhpSdk\Responses\Users\Ewallet;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class EwalletRequest extends AbstractRequest
{
    /**
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create"})
     *
     * @Groups({"create"})
     *
     * @var string User id
     */
    protected $id;

    /**
     * @inheritdoc
     */
    public function expectObject(): ?string
    {
        return Ewallet::class;
    }

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/%s/ewallets', $this->id)
        ];
    }
}
