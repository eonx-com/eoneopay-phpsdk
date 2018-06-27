<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Requests\Merchants;

use EoneoPay\PhpSdk\Requests\Merchants\MerchantRequest;
use Tests\EoneoPay\PhpSdk\RequestTestCase;

class MerchantRequestTest extends RequestTestCase
{
    public function testSuccessfulMerchantRequests(): void
    {
        // Create request.
        $email = 'test_'.\time().'@test.com';
        $externalId = (string)\time();
        $createRequest = new MerchantRequest(
            [
                'email' => $email,
                'external_id' => $externalId
            ]
        );

        /** @var \EoneoPay\PhpSdk\Responses\Merchant $merchant */
        $merchant = $this->client->create($createRequest);
        self::assertSame($email, $merchant->getEmail());
        self::assertSame($externalId, $merchant->getExternalId());
        self::assertNotEmpty($merchant->getId());
        self::assertNotEmpty($merchant->getApiKey());

        // Update request.
        $newEmail = 'test_'.\time().'@test.com';
        $newExternalId = (string)\time();
        $updateRequest = new MerchantRequest([
            'id' => $merchant->getId(),
            'external_id' => $newExternalId,
            'email' => $newEmail
        ]);

        $response = $this->client->update($updateRequest);

        self::assertSame($newEmail, $response->getEmail());
        self::assertSame($newExternalId, $response->getExternalId());
        self::assertNotEmpty($response->getId());
        self::assertNotEmpty($merchant->getApiKey());

//        // Delete request.
//        $deleteRequest = new MerchantRequest([
//            'id' => $merchant->getId()
//        ]);
//
//        // TODO: can't delete because of the foreign key constraint.
//        $response = $this->client->delete($deleteRequest);
    }
}
