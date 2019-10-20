<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method Balance|null getBalance()
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
     * {@inheritdoc}
     */
    public function uris(): array
    {
        // The id/reference check is required since find() uses id always, but findOneBy() will use reference
        return [
            self::CREATE => '/ewallets',
            self::GET => \sprintf('/ewallets/%s', $this->id ?? $this->reference),
            self::LIST => '/ewallets',
        ];
    }
}
