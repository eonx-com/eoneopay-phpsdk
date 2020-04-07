<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\V2\Transactions\Allocations;

use EoneoPay\PhpSdk\Endpoints\V2\Ewallet;
use EoneoPay\PhpSdk\Traits\V2\Transactions\Allocations\RecordTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getAmount()
 * @method string|null getCreatedAt()
 * @method Ewallet|null getEwallet()
 * @method string|null getUpdatedAt()
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
