<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\PaymentSources;

use Symfony\Component\Serializer\Annotation\Groups;

trait PointsTrait
{
    /**
     * Account id.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $accountId;

    /**
     * External id.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $externalId;

    /**
     * Provider id.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $providerId;
}
