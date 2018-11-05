<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

trait SecurityTrait
{
    /**
     * Action url.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $actionUrl;

    /**
     * Cavv.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $cavv;

    /**
     * Enrolment status.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $enrolmentStatus;

    /**
     * Transaction id.
     *
     * @Assert\NotBlank(groups={"create", "update"})
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $id;

    /**
     * Payload for verification.
     *
     * @Assert\NotBlank(groups={"update"})
     *
     * @Groups({"update"})
     *
     * @var null|string
     */
    protected $payload;

    /**
     * Request payload.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $requestPayload;

    /**
     * Response payload.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $responsePayload;

    /**
     * Return url.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $returnUrl;

    /**
     * Secured.
     *
     * @Groups({"create", "update"})
     *
     * @var null|bool
     */
    protected $secured;

    /**
     * Status.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $status;

    /**
     * Xid.
     *
     * @Groups({"create", "update"})
     *
     * @var null|string
     */
    protected $xid;
}
