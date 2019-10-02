<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Users\WebhookSubscriptions\SubscribedActivity;
use EoneoPay\PhpSdk\Endpoints\Webhook;
use EoneoPay\Utils\DateTime;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Webhook
 */
final class WebhookTest extends TestCase
{
    /**
     * Test create webhook successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testCreate(): void
    {
        $response = $this->getResponseData();

        $expectedActivity = [
            new SubscribedActivity([
            'activity' => 'transaction.updated',
            'userWebhook' => null
            ])
        ];

        $webhook = $this->createApiManager($response)->create(
            (string)\getenv('PAYMENTS_API_KEY'),
            new Webhook([
                'headers' => ['sdkkey1' => 'sdkval1'],
                'url' => 'http://sdktest.local',
            ])
        );

        self::assertInstanceOf(Webhook::class, $webhook);

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\Webhook $webhook
         *
         * @see https://youtrack.jetbrains.com/issue/WI-37859 - typehint required until PhpStorm recognises assertion
         */
        self::assertSame('http://sdktest.local', $webhook->getUrl());
        self::assertSame(['sdkkey1' => 'sdkval1'], $webhook->getHeaders());
        self::assertSame('POST', $webhook->getMethod());
        self::assertSame('json', $webhook->getSerializationFormat());
        self::assertEquals($expectedActivity, $webhook->getActivities());
    }

    /**
     * Test list webhooks successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testList(): void
    {
        $webhooks = $this->createApiManager([
            $this->getResponseData(),
        ])->findAll(Webhook::class, (string)\getenv('PAYMENTS_API_KEY'));

        self::assertCount(1, $webhooks);
    }

    /**
     * Test delete webhook successfully.
     *
     * @return void
     */
    public function testRemove(): void
    {
        $webhook = $this->createApiManager()->delete(
            (string)\getenv('PAYMENTS_API_KEY'),
            new Webhook([
                'headers' => ['sdkkey1' => 'sdkval1'],
                'url' => 'http://original.local',
            ])
        );

        self::assertInstanceOf(Webhook::class, $webhook);
    }

    /**
     * Test update webhook successfully.
     *
     * @return void
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function testUpdate(): void
    {
        $response = $this->getResponseData();
        $response['method'] = 'PUT';

        $expectedActivity = [
            new SubscribedActivity([
                'activity' => 'transaction.updated',
                'userWebhook' => null
            ])
        ];

        $webhook = $this->createApiManager($response)->update(
            (string)\getenv('PAYMENTS_API_KEY'),
            new Webhook([
                'activities' => [
                    ['activity' => 'token.created']
                ],
                'url' => 'http://original.local',
            ])
        );

        self::assertInstanceOf(Webhook::class, $webhook);

        /**
         * @var \EoneoPay\PhpSdk\Endpoints\Webhook $webhook
         *
         * @see https://youtrack.jetbrains.com/issue/WI-37859 - typehint required until PhpStorm recognises assertion
         */
        self::assertSame('http://sdktest.local', $webhook->getUrl());
        self::assertSame('PUT', $webhook->getMethod());
        self::assertEquals($expectedActivity, $webhook->getActivities());
    }

    /**
     * Get response data.
     *
     * @return mixed[]
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    private function getResponseData(): array
    {
        $date = new DateTime();

        return [
            'activities' => [
                ['activity' => 'transaction.updated']
            ],
            'created_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU),
            'headers' => ['sdkkey1' => 'sdkval1'],
            'id' => '6NC2WWP',
            'method' => 'POST',
            'serializationFormat' => 'json',
            'url' => 'http://sdktest.local',
            'user' => [
                'created_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU),
                'email' => 'user@email.test',
                'updated_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU),
            ],
            'updated_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU),

        ];
    }
}
