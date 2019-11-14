<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait SecurityTrait
{
    /**
     * Security action url.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $actionUrl;

    /**
     * Amount array with currency and total.
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Amount|null
     */
    protected $amount;

    /**
     * Authentication result.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $authenticationResult;

    /**
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $cavv;

    /**
     * Created at date.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $eci;

    /**
     * @Groups({"create", "update"})
     *
     * Enrolment status.
     *
     * @var string|null
     */
    protected $enrolmentStatus;

    /**
     * Security Id.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $id;

    /**
     * Security metadata.
     *
     * @Groups({"create", "update"})
     *
     * @var mixed[]|null
     */
    protected $metadata;

    /**
     * Security payload.
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $payload;

    /**
     * Security payment source.
     *
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * Security request payload.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $requestPayload;

    /**
     * Security response payload.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $responsePayload;

    /**
     * Security return url.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $returnUrl;

    /**
     * @Groups({"create", "update"})
     *
     * @var bool|null
     */
    protected $secured;

    /**
     * Status.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $status;

    /**
     * Updated at date.
     *
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @Groups({"create", "update"})
     *
     * @var string|null
     */
    protected $xid;
}
