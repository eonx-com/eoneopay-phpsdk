<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\SecurityTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getActionUrl()
 * @method mixed[]|null getAmount()
 * @method string|null getAuthenticationResult()
 * @method string|null getCavv()
 * @method string|null getCreatedAt()
 * @method string|null getEci()
 * @method string|null getEnrolmentStatus()
 * @method string|null getId()
 * @method mixed[]|null getMetadata()
 * @method string|null getPayload()
 * @method PaymentSource|null getPaymentSource()
 * @method string|null getRequestPayload()
 * @method string|null getResponsePayload()
 * @method string|null getReturnUrl()
 * @method string|null getSecured()
 * @method string|null getStatus()
 * @method string|null getUpdatedAt()
 * @method string|null getXid()
 */
class Security extends Entity
{
    use SecurityTrait;

    /**
     * Get uri for this entity.
     *
     * For an example,
     *
     * return [
     *      self::CREATE => 'http://localhost/<endpoint-path>',
     *      self::DELETE => 'http://localhost/<endpoint-path>',
     *      self::GET => 'http://localhost/<endpoint-path>',
     *      self::LIST => 'http://localhost/<endpoint-path>',
     *      self::UPDATE => 'http://localhost/<endpoint-path>'
     * ];
     *
     * @return mixed[] Api endpoint uris
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/security/%s', $this->getId()),
            self::UPDATE => \sprintf('/security/%s', $this->getId())
        ];
    }
}
