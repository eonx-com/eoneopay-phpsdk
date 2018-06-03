<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Abstracts\AbstractDataTransferObject;
use EoneoPay\PhpSdk\Responses\Payloads\Merchant;
use EoneoPay\PhpSdk\Traits\DefinesUris;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestMethodInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestObjectInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @SuppressWarnings(PHPMD.ShortVariable) id a required name of the url.
 */
class MerchantRequest extends AbstractDataTransferObject implements RequestObjectInterface, RequestMethodInterface
{
    use DefinesUris;

    /**
     * @Assert\Email(groups={"create", "update"})
     * @Assert\NotBlank(groups={"create"})
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $email;

    /**
     * @Assert\NotBlank(groups={"create"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $externalId;

    /**
     * @Assert\NotBlank(groups={"update", "delete"})
     * @Assert\Type(type="string", groups={"create", "update"})
     *
     * @var string
     */
    protected $id;

    /**
     * Specify the expected returned object.
     *
     * @return string
     */
    public function expectObject(): ?string
    {
        return Merchant::class;
    }

    /**
     * Get email.
     *
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get external id.
     *
     * @return null|string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * Get id.
     *
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Don't prefix method with get or set as serializer will output the method name as attributes.
     *
     * Add options along with sending the request. For example, adding api key in the header.
     *
     * @return mixed[]
     */
    public function options(): array
    {
        return [];
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return MerchantRequest
     */
    public function setEmail(string $email): MerchantRequest
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set external_id.
     *
     * @param string $externalId
     *
     * @return MerchantRequest
     */
    public function setExternalId(string $externalId): MerchantRequest
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return MerchantRequest
     */
    public function setId(string $id): MerchantRequest
    {
        $this->id = $id;

        return $this;
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
            self::CREATE => $this->url('merchants'),
            self::UPDATE => $this->url(\sprintf('merchants/%s', $this->getId())),
            self::DELETE => $this->url(\sprintf('merchants/%s', $this->getId()))
        ];
    }
}
