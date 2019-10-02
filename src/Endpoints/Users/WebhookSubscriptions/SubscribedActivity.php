<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Endpoints\Users\WebhookSubscriptions;

use EoneoPay\PhpSdk\Endpoints\Webhook;
use EoneoPay\PhpSdk\Traits\Users\Webhook\SubscribedActivityTrait;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getActivity()
 * @method Webhook|null getUserWebhook()
 * @method $this setActivity(string $activity)
 */
class SubscribedActivity extends Entity
{
    use SubscribedActivityTrait;

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [];
    }
}
