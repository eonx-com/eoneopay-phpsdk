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
 * @method PaymentSource|null getFundingSource()
 * @method string|null getTargetAmount()
 * @method string|null getThreshold()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
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
            self::CREATE => \sprintf('/ewallets/%s/funding', $this->getEwalletReference()),
            self::DELETE => \sprintf(
                '/ewallets/%s/funding/%s',
                $this->getEwalletReference(),
                $this->id
            ),
        ];
    }

    /**
     * Get ewallet reference.
     *
     * @return string
     */
    private function getEwalletReference(): ?string
    {
        return ($this->ewallet instanceof Ewallet) === true ? $this->ewallet->getReference() : null;
    }
}
