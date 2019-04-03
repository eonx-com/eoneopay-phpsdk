<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints;

use EoneoPay\PhpSdk\Endpoints\Webhook;
use EoneoPay\Utils\DateTime;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\Webhook
 */
class WebhookTest extends TestCase
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

        $webhook = $this->createApiManager($response)->create(
            (string)\getenv('PAYMENTS_API_KEY'),
            new Webhook([
                'headers' => ['sdkkey1' => 'sdkval1'],
                'url' => 'http://sdktest.local'
            ])
        );

        self::assertSame(
            'http://sdktest.local',
            ($webhook instanceof Webhook) === true ? $webhook->getUrl() : null
        );
        self::assertCount(1, $this->getHeaders($webhook));
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
            $this->getResponseData()
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
                'url' => 'http://original.local'
            ])
        );

        self::assertTrue($webhook);
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

        $webhook = $this->createApiManager($response)->update(
            (string)\getenv('PAYMENTS_API_KEY'),
            new Webhook([
                'url' => 'http://original.local'
            ])
        );

        self::assertSame(
            'http://sdktest.local',
            ($webhook instanceof Webhook) === true ? $webhook->getUrl() : null
        );
    }

    /**
     * Get webhook headers.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $webhook
     *
     * @return mixed[]
     */
    private function getHeaders(EntityInterface $webhook): array
    {
        if (($webhook instanceof Webhook) === true &&
            ($webhook->getHeaders() !== null)) {
            return $webhook->getHeaders();
        }

        return [];
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
            'created_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU),
            'headers' => ['sdkkey1' => 'sdkval1'],
            'id' => '6NC2WWP',
            'url' => 'http://sdktest.local',
            'user' => [
                'created_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU),
                'email' => 'user@email.test',
                'updated_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU)
            ],
            'updated_at' => $date->format(UtcDateTimeInterface::FORMAT_ZULU)

        ];
    }
}
