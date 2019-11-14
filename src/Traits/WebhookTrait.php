<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits;

use Symfony\Component\Serializer\Annotation\Groups;

trait WebhookTrait
{
    /**
     * Subscribed activities.
     *
     * @Groups({"create", "list", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Users\WebhookSubscriptions\SubscribedActivity[]
     */
    protected $activities;

    /**
     * Headers.
     *
     * @Groups({"create", "list", "update"})
     *
     * @var mixed[]
     */
    protected $headers;

    /**
     * Webhook id.
     *
     * @Groups({"list"})
     *
     * @var string
     */
    protected $id;

    /**
     * Http method this webhook will be delivered as.
     *
     * @Groups({"create", "list", "update"})
     *
     * @var string
     */
    protected $method;

    /**
     * The content type of payload delivery.
     *
     * @Groups({"create", "list", "update"})
     *
     * @var string
     */
    protected $serializationFormat;

    /**
     * Url.
     *
     * @Groups({"create", "list", "update"})
     *
     * @var string
     */
    protected $url;

    /**
     * User associated with this webhook.
     *
     * @Groups({"create", "list"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\User
     */
    protected $user;
}
