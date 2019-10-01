<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait WebhookTrait
{
    /**
     * Subscribed activities.
     *
     * @var mixed[]
     */
    protected $activities;

    /**
     * Headers.
     *
     * @Groups({"create", "update"})
     *
     * @var mixed[]
     */
    protected $headers;

    /**
     * Webhook id.
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $id;

    /**
     * Url.
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $url;

    /**
     * User associated with this webhook.
     *
     * @Groups({"create", "get", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;
}
