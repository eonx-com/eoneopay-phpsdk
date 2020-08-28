<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2\PaymentSources;

use EoneoPay\PhpSdk\Endpoints\V2\PaymentSource;
use EoneoPay\PhpSdk\Traits\PaymentSources\PointsTrait;

/**
 * @method string|null getAccountId()
 * @method string|null getExternalId()
 * @method string|null getProviderId()
 */
class Points extends PaymentSource
{
    use PointsTrait;

    /**
     * Points constructor.
     *
     * @param mixed[]|null $data
     * @param bool|null $isOneTime
     */
    public function __construct(?array $data = null, ?bool $isOneTime = null)
    {
        parent::__construct($data, $isOneTime);

        $this->type = self::SOURCE_POINTS;
    }
}
