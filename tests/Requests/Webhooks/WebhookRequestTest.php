<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Webhooks;

use EoneoPay\PhpSdk\Requests\Webhooks\DeleteRequest;
use EoneoPay\PhpSdk\Requests\Webhooks\WebhookRequest;
use EoneoPay\PhpSdk\Responses\Webhook;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

/**
 * @covers \EoneoPay\PhpSdk\Requests\Webhooks\DeleteRequest
 * @covers \EoneoPay\PhpSdk\Requests\Webhooks\WebhookRequest
 */
class WebhookRequestTest extends RequestTestCase
{
    /**
     * Test register webhook successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * @throws \Exception
     */
    public function testRegisterSuccessfully(): void
    {
        $data = $this->getWebhookData();

        $response = $this->createClient($data)->create(new WebhookRequest($data));

        self::assertInstanceOf(Webhook::class, $response);
        /** @var \EoneoPay\PhpSdk\Responses\Webhook $response */
        self::assertSame($data['event'], $response->getEvent());
        self::assertSame($data['url'], $response->getUrl());
    }

    /**
     * Test deregister webhook successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * @throws \Exception
     */
    public function testDeregisterSuccessfully(): void
    {
        self::assertNull($this->createClient([])->delete(new DeleteRequest([
            'id' => 'deregister-webhook-id'
        ])));
    }

    /**
     * Test list webhooks successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * @throws \Exception
     */
    public function testListSuccessfully(): void
    {
        $data = $this->getWebhookData();

        /** @var \Countable $list */
        $list = $this->createClient([$data])->list(new WebhookRequest());

        self::assertGreaterThan(0, \count($list));
    }

    /**
     * Test update webhook successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     */
    public function testUpdateSuccessfully(): void
    {
        $data = $this->getWebhookData();

        $updated = $this->createClient($data)->update(new WebhookRequest($data));

        self::assertInstanceOf(Webhook::class, $updated);
        /** @var \EoneoPay\PhpSdk\Responses\Webhook $updated */
        self::assertSame($data['event'], $updated->getEvent());
        self::assertSame($data['url'], $updated->getUrl());
    }

    /**
     * Get webhook data.
     *
     * @return mixed[]
     *
     * @throws \Exception
     */
    private function getWebhookData(): array
    {
        return [
            'event' => \uniqid('test-event-', false),
            'payload_format' => 1,
            'id' => \uniqid('', false),
            'url' => 'https://subdomain.test.com'
        ];
    }
}
