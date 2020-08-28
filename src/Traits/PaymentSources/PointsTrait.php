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
     * Api key.
     *
     * @var string|null
     */
    protected $apiKey;

    /**
     * External id.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $externalId;

    /**
     * Number of points.
     *
     * @Groups({"create"})
     *
     * @var int|null
     */
    protected $points;

    /**
     * Provider id.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $providerId;
}
