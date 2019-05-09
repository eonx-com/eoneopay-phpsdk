<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Managers;

use EoneoPay\PhpSdk\Exceptions\CriticalException;
use EoneoPay\PhpSdk\Factories\ExceptionFactory;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\RepositoryInterface;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Tests\EoneoPay\PhpSdk\Stubs\Entities\EntityStub;
use Tests\EoneoPay\PhpSdk\Stubs\Entities\UserStub;
use Tests\EoneoPay\PhpSdk\Stubs\Managers\SdkManagerStub;
use Tests\EoneoPay\PhpSdk\Stubs\Repositories\UserRepositoryStub;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Managers\EoneoPayApiManager
 */
class EoneoPayApiManagerTest extends TestCase
{
    /**
     * Test create entity successfully.
     *
     * @return void
     */
    public function testCreate(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        $actual = $this->getManager()->create('api-key', $expected);

        self::assertInstanceOf(EntityStub::class, $actual);
        self::assertSame(
            $expected->getEntityId(),
            ($actual instanceof EntityStub) === true ? $actual->getEntityId() : null
        );
    }

    /**
     * Test create entity successfully.
     *
     * @return void
     */
    public function testDelete(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        self::assertInstanceOf(EntityInterface::class, $this->getManager()->delete('api-key', $expected));
    }



    /**
     * Test that find will return expected entity.
     *
     * @return void
     */
    public function testFind(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        $actual = $this->getManager($expected)->find(EntityStub::class, 'api-key', $expected->getEntityId() ?? '');

        self::assertInstanceOf(EntityStub::class, $actual);
        self::assertSame(
            $expected->getEntityId(),
            ($actual instanceof EntityStub) === true ? $actual->getEntityId() : null
        );
    }

    /**
     * Test that find all will return expected number of entities.
     *
     * @return void
     */
    public function testFindAll(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        $entities = $this->getManager($expected)->findAll(EntityStub::class, 'api-key');

        self::assertCount(1, $entities);
        self::assertInstanceOf(EntityStub::class, $entities[0]);
        self::assertSame(
            $expected->getEntityId(),
            ($entities[0] instanceof EntityStub) === true ? $entities[0]->getEntityId() : null
        );
    }



    /**
     * Test that find by with provided criteria will return expected number of entities.
     *
     * @return void
     */
    public function testFindBy(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        $entities = $this->getManager($expected)->findBy(EntityStub::class, 'api-key', [
            'entityId' => $expected->getEntityId()
        ]);

        self::assertCount(1, $entities);
        self::assertInstanceOf(EntityStub::class, $entities[0]);
        self::assertSame(
            $expected->getEntityId(),
            ($entities[0] instanceof EntityStub) === true ? $entities[0]->getEntityId() : null
        );
    }



    /**
     * Test if find exception is thrown on invalid response
     *
     * @return void
     */
    public function testFindException(): void
    {
        $this->expectException(CriticalException::class);
        $this->createApiManager([
            'code' => 0
        ], 400)
            ->find(
                EntityStub::class,
                'api-key',
                'dummy-id'
            );
    }

    /**
     * Test that find one by will return expected entity.
     *
     * @return void
     */
    public function testFindOneBy(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        $actual = $this->getManager($expected)->findOneBy(EntityStub::class, 'api-key', [
            'entityId' => $expected->getEntityId()
        ]);

        self::assertInstanceOf(EntityStub::class, $actual);
        self::assertSame(
            $expected->getEntityId(),
            ($actual instanceof EntityStub) === true ? $actual->getEntityId() : null
        );
    }



    /**
     * Test that getRepository() method always returns a repository.
     *
     * @return void
     */
    public function testGetRepository(): void
    {
        /** @noinspection UnnecessaryAssertionInspection Testing that getRepository() always returns a repository */
        self::assertInstanceOf(
            RepositoryInterface::class,
            $this->getManager()->getRepository(EntityStub::class)
        );
    }

    /**
     * Test that getRepository() method returns a repository associated with the entity.
     *
     * @return void
     */
    public function testGetRepositoryWithCustomRepository(): void
    {
        self::assertInstanceOf(
            UserRepositoryStub::class,
            $this->getManager()->getRepository(UserStub::class)
        );
    }

    /**
     * Test that update will perform update on entity successfully.
     *
     * @return void
     */
    public function testUpdate(): void
    {
        $userId = $this->generateId();

        $expected = new UserStub([
            'userId' => $userId,
            'email' => 'updated@email.test'
        ]);

        $actual = $this->getManager($expected)->update('api-key', new UserStub([
            'userId' => $userId,
            'email' => 'original@email.test'
        ]));

        self::assertInstanceOf(UserStub::class, $actual);
        self::assertSame(
            $expected->getUserId(),
            ($actual instanceof UserStub) === true ? $actual->getUserId() : null
        );
        self::assertSame(
            'updated@email.test',
            ($actual instanceof UserStub) === true ? $actual->getEmail() : null
        );
    }



    /**
     * Get EoneoPay api manager.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface|null $entity
     *
     * @return \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface
     */
    private function getManager(?EntityInterface $entity = null): EoneoPayApiManagerInterface
    {
        return new EoneoPayApiManager(new SdkManagerStub($entity), new ExceptionFactory());
    }
}
