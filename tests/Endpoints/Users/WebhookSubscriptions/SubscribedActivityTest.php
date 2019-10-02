<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\Users\WebhookSubscriptions;

use EoneoPay\PhpSdk\Endpoints\Users\WebhookSubscriptions\SubscribedActivity;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Users\WebhookSubscriptions\SubscribedActivity
 */
class SubscribedActivityTest extends TestCase
{
    /**
     * Test the uris method return empty array.
     *
     * @return void
     */
    public function testUris(): void
    {
        $activity = new SubscribedActivity();

        self::assertSame([], $activity->uris());
    }
}
