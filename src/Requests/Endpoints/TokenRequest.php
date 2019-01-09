<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Endpoints;

use EoneoPay\PhpSdk\Requests\AbstractRequest;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

abstract class TokenRequest extends AbstractRequest
{
    /**
     * @Assert\NotBlank(groups={"get"})
     *
     * @Groups({"get"})
     *
     * @var string|null
     */
    protected $token;

    /**
     * @inheritdoc
     */
    public function uris(): array
    {
        return [
            self::GET => \sprintf('/token/%s', $this->token)
        ];
    }
}
