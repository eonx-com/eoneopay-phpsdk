<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use EoneoPay\PhpSdk\Endpoints\PaymentSource;
use Symfony\Component\Serializer\Annotation\Groups;

trait SecurityTrait
{
    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $actionUrl;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $amount;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $authenticaionResult;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $cavv;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $eci;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $enrolmentStatus;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string
     */
    protected $id;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $metadata;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $requestPayload;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $responsePayload;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $returnUrl;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $secured;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $status;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $xid;


}