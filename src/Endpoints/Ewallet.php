<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method mixed[]|null getBalances()
 * @method string|null getCreatedAt()
 * @method string|null getCurrency()
 * @method string|null getId()
 * @method string|null getPan()
 * @method bool getPrimary()
 * @method string|null getReference()
 * @method string|null getType()
 * @method string|null getUpdatedAt()
 * @method User|null getUser()
 */
class Ewallet extends Entity
{
    use EwalletTrait;

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
            self::CREATE => '/ewallets',
            self::GET => \sprintf('/ewallets/%s', $this->reference),
            self::LIST => '/ewallets'
        ];
    }
}
