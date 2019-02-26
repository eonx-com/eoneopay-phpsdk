<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\Users\ContractTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getCreatedAt()
 * @method string|null getCurrency()
 * @method string|null getEwallet()
 * @method string|null getFixedFee()
 * @method string|null getGroup()
 * @method string|null getType()
 * @method string|null getUpdatedAt()
 * @method User|null getUser()
 * @method string|null getVariableRate()
 */
class Contract extends Entity
{
    use ContractTrait;

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
            self::CREATE => \sprintf('/users/%s/contracts', $this->getUserId())
        ];
    }

    /**
     * Get user id.
     *
     * @return string
     */
    private function getUserId(): string
    {
        return ($this->getUser() instanceof User) === true ? $this->getUser()->getId() ?? '' : '';
    }
}
