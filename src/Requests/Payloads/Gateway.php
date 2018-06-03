<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Payloads;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Gateway extends AbstractDataTransferObject
{
    /**
     * Certificate.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var null|string $certificate
     */
    protected $certificate;

    /**
     * The information.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var null|string $info
     */
    protected $info;

    /**
     * Line of business.
     *
     * @Assert\NotBlank(groups={"create", "delete", "get", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "get", "update"})
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var null|string
     */
    protected $lineOfBusiness;

    /**
     * Password.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var null|string $password
     */
    protected $password;

    /**
     * Service.
     *
     * @Assert\NotBlank(groups={"create", "delete", "get", "update"})
     * @Assert\Type(type="string", groups={"create", "delete", "get", "update"})
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var null|string $service
     */
    protected $service;

    /**
     * Username.
     *
     * @Groups({"create", "delete", "get", "update"})
     *
     * @var null|string $username
     */
    protected $username;

    /**
     * Get certificate.
     *
     * @return null|string
     */
    public function getCertificate(): ?string
    {
        return $this->certificate;
    }

    /**
     * Get info.
     *
     * @return null|string
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * Get line_of_business.
     *
     * @return null|string
     */
    public function getLineOfBusiness(): ?string
    {
        return $this->lineOfBusiness;
    }

    /**
     * Get password.
     *
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Get service.
     *
     * @return null|string
     */
    public function getService(): ?string
    {
        return $this->service;
    }

    /**
     * Get username.
     *
     * @return null|string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set certificate.
     *
     * @param null|string $certificate
     *
     * @return self
     */
    public function setCertificate(?string $certificate = null): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * Set info.
     *
     * @param null|string $info
     *
     * @return self
     */
    public function setInfo(?string $info = null): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Set line_of_business.
     *
     * @param string $lineOfBusiness
     *
     * @return Gateway
     */
    public function setLineOfBusiness(string $lineOfBusiness): Gateway
    {
        $this->lineOfBusiness = $lineOfBusiness;

        return $this;
    }

    /**
     * Set password.
     *
     * @param null|string $password
     *
     * @return self
     */
    public function setPassword(?string $password = null): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set service.
     *
     * @param null|string $service
     *
     * @return self
     */
    public function setService(?string $service = null): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Set username.
     *
     * @param null|string $username
     *
     * @return self
     */
    public function setUsername(?string $username = null): self
    {
        $this->username = $username;

        return $this;
    }
}
