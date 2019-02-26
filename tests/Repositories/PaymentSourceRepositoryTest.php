<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Repositories;

use EoneoPay\PhpSdk\Endpoints\PaymentSources\CreditCard;
use EoneoPay\PhpSdk\Repositories\PaymentSourceRepository;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Tests\EoneoPay\PhpSdk\Stubs\Entities\EntityStub;
use Tests\EoneoPay\PhpSdk\Stubs\Managers\EoneoPayApiManagerStub;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Repositories\PaymentSourceRepository
 */
class PaymentSourceRepositoryTest extends TestCase
{
    /**
     * Test find by token successfully.
     *
     * @return void
     */
    public function testFindByToken(): void
    {
        $creditCard = new CreditCard([
            'token' => $this->generateId()
        ]);

        $actual = $this->getRepository($creditCard)->findByToken($creditCard->getToken() ?? '', 'api-key');

        self::assertSame($creditCard->getToken(), $actual->getToken() ?? '');
    }

    /**
     * Get repository.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface|null $entity
     *
     * @return \EoneoPay\PhpSdk\Repositories\PaymentSourceRepository
     */
    private function getRepository(?EntityInterface $entity = null): PaymentSourceRepository
    {
        return new PaymentSourceRepository(
            new EoneoPayApiManagerStub($entity ?? new EntityStub()),
            \get_class($entity ?? new EntityStub())
        );
    }
}
