<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Transactions\Allocations;

use EoneoPay\PhpSdk\Endpoints\Ewallet;
use EoneoPay\PhpSdk\Traits\Transactions\Allocations\RecordTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAmount()
 * @method string|null getCreatedAt()
 * @method Ewallet|null getEwallet()
 * @method string|null getUpdatedAt()
 *
 * @deprecated Use EoneoPay\PhpSdk\Endpoints\V1 objects instead.
 */
class Record extends Entity
{
    use RecordTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [];
    }
}
