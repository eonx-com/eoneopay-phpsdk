<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use EoneoPay\PhpSdk\Traits\Users\EwalletFundingTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method PaymentSource[]|null getEndpoints()
 * @method Ewallet|null getEwallet()
 * @method string|null getId()
 * @method PaymentSource|null getPrimaryEndpoint()
 * @method string|null getTargetAmount()
 * @method string|null getThreshold()
 */
class EwalletFunding extends Entity
{
    use EwalletFundingTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => \sprintf('/users/ewallets/%s/funding', $this->ewallet->getReference()),
            self::DELETE => \sprintf(
                '/users/ewallets/%s/funding/%s',
                $this->ewallet->getReference(),
                $this->id
            ),
        ];
    }
}
