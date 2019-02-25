<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Traits\EwalletTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

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
            self::CREATE => 'http://payments.box/ewallets',
            self::GET => \sprintf('http://payments.box/ewallets/%s', $this->reference)
        ];
    }
}
