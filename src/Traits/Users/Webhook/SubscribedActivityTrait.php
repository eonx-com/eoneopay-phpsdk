<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Traits\Users\Webhook;

trait SubscribedActivityTrait
{
    /**
     * Activity key.
     *
     * @var string
     */
    protected $activity;

    /**
     * User Webhook.
     *
     * @var \EoneoPay\PhpSdk\Endpoints\Webhook
     */
    protected $userWebhook;
}
