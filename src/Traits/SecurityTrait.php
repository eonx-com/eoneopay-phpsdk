<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait SecurityTrait
{
    /**
     * Security action url.
     *
     * @var string|null
     */
    protected $actionUrl;

    /**
     * Amount array with currency and total.
     *
     * @Groups({"create"})
     *
     * @var mixed[]|null
     */
    protected $amount;

    /**
     * Authentication result.
     *
     * @var string|null
     */
    protected $authenticationResult;

    /**
     * @var string|null
     */
    protected $cavv;

    /**
     * Created at date.
     *
     * @var string|null
     */
    protected $createdAt;

    /**
     * @var string|null
     */
    protected $eci;

    /**
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
     * @Groups({"create"})
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
     * @Groups({"create"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\PaymentSource|null
     */
    protected $paymentSource;

    /**
     * Security request payload.
     *
     * @var string|null
     */
    protected $requestPayload;

    /**
     * Security response payload.
     *
     * @var string|null
     */
    protected $responsePayload;

    /**
     * Security return url.
     *
     * @Groups({"create"})
     *
     * @var string|null
     */
    protected $returnUrl;

    /**
     * @var bool|null
     */
    protected $secured;

    /**
     * Status.
     *
     * @var string|null
     */
    protected $status;

    /**
     * Updated at date.
     *
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @var string|null
     */
    protected $xid;
}
