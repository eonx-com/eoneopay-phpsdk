<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait SecurityTrait
{
    /**
     * Security action url.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $actionUrl;

    /**
     * Amount array with currency and total.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $amount;

    /**
     * Authentication result.
     *
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
     * Created at date.
     *
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
     * Enrolment status.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $enrolmentStatus;

    /**
     * Security Id.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $id;

    /**
     * Security metadata.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var mixed[]|null
     */
    protected $metadata;

    /**
     * Security payload.
     *
     * @Groups({"update"})
     *
     * @var string
     */
    protected $payload;

    /**
     * Security payment source.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * Security request payload.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $requestPayload;

    /**
     * Security response payload.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $responsePayload;

    /**
     * Security return url.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $returnUrl;

    /**
     * @Groups({"create", "get", "list", "update"})
     *
     * @var bool|null
     */
    protected $secured;

    /**
     * Status.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var string|null
     */
    protected $status;

    /**
     * Updated at date.
     *
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
