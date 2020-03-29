<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use EoneoPay\PhpSdk\Endpoints\User;
use EoneoPay\PhpSdk\Traits\Users\ContractTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAction()
 * @method string|null getCreatedAt()
 * @method string|null getCurrency()
 * @method Ewallet|null getEwallet()
 * @method string|null getFixedFee()
 * @method string|null getGroup()
 * @method string|null getUpdatedAt()
 * @method User|null getUser()
 * @method string|null getVariableRate()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class Contract extends Entity
{
    use ContractTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/%s/contracts', $this->getUserId()),
            self::GET => \sprintf('/users/%s/contracts', $this->getUserId())
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
