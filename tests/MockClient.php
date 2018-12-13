<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use EoneoPay\Utils\DateTime;
use EoneoPay\Utils\Interfaces\UtcDateTimeInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use LoyaltyCorp\SdkBlueprint\Sdk\Client as BaseClient;

class MockClient extends BaseClient
{
    /**
     * Construct mock HTTP client.
     *
     * @param mixed[] $content
     * @param int|null $responseCode
     * @param mixed[]|null $header
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    public function __construct(array $content, ?int $responseCode = null, ?array $header = null)
    {
        $header = $header ?? [];
        $responseCode = $responseCode ?? 200;

        $content = $this->formatData($content);

        if (\array_key_exists(0, $content) === true) {
            $content[0] = $this->formatData($content[0]);
        }

        $handler = new MockHandler([
            new Response($responseCode, $header, \json_encode($content))
        ]);

        parent::__construct(new GuzzleClient([
            'handler' => $handler
        ]));
    }

    /**
     * Format response data.
     *
     * @param mixed[] $content
     *
     * @return mixed[]
     *
     * @throws \EoneoPay\Utils\Exceptions\InvalidDateTimeStringException
     */
    private function formatData(array $content): array
    {
        if (isset($content['amount'])) {
            /**  @var \EoneoPay\PhpSdk\Requests\Payloads\Amount $amount */
            $amount = $content['amount'];

            $content = \array_replace($content, [
                'approved' => true,
                'completed_at' => (new DateTime())->format(UtcDateTimeInterface::FORMAT_ZULU),
                'amount' => [
                    'currency' => $amount->getCurrency(),
                    'payment_fee' => $amount->getPaymentFee(),
                    'subtotal' => $amount->getSubtotal(),
                    'total' => $amount->getTotal()
                ],
                'status' => 'completed'
            ]);
        }

        return $content;
    }
}
