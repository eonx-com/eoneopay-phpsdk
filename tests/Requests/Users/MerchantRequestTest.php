<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Users;

use EoneoPay\PhpSdk\Requests\Users\MerchantRequest;
use EoneoPay\PhpSdk\Responses\Payloads\Merchant;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class MerchantRequestTest extends RequestTestCase
{
    /**
     * Client should create, update and delete successfully a merchant on eoneopay.
     *
     * @return void
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidRequestUriException
     */
    public function testCreateUpdateDeleteSuccessfully(): void
    {
        $random = (string)\time();

        $merchant = new MerchantRequest([
            'email' => \sprintf('nathan-%s@test.com', $random),
            'external_id' => \sprintf('nathan-%s-da-bomb', $random),
            'password' => 'password'
        ]);

        $response = $this->client->create($merchant);

        self::assertInstanceOf(Merchant::class, $response);

        $merchant->setExternalId(\sprintf('new-external-id-%s', $random));
        $merchant->setId($response->getId());

        $response = $this->client->update($merchant);

        self::assertInstanceOf(Merchant::class, $response);

        $response = $this->client->delete($merchant);

        self::assertInstanceOf(Merchant::class, $response);
        self::assertNull($response->getId());
    }
}
