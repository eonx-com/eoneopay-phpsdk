<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Token extends AbstractDataTransferObject
{
    /**
     * @Assert\NotBlank(groups={"create", "update"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $token;

    /**
     * Get token.
     *
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Set token.
     *
     * @param string $token
     *
     * @return Token
     */
    public function setToken(string $token): Token
    {
        $this->token = $token;

        return $this;
    }
}
