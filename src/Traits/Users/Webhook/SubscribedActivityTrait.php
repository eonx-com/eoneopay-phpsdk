<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users\Webhook;

use Symfony\Component\Serializer\Annotation\Groups;

trait SubscribedActivityTrait
{
    /**
     * Activity key
     *
     * @Groups({"create", "update"})
     *
     * @var string
     */
    protected $activity;

    /**
     * User Webhook.
     *
     * @Groups({"create", "update"})
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Webhook
     */
    protected $userWebhook;
}
