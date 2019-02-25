<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Managers;

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
        $this->performAssertions($expected, $actual);
    }

    /**
     * Test create entity successfully.
     *
     * @return void
     */
    public function testDelete(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        self::assertTrue($this->getManager()->delete('api-key', $expected));
    }

    /**
     * Test that find will return expected entity.
     *
     * @return void
     */
    public function testFind(): void
    {
        $expected = new EntityStub(['entityId' => $this->generateId()]);

        $actual = $this->getManager($expected)->find(EntityStub::class, 'api-key', $expected->getEntityId());

        self::assertInstanceOf(EntityStub::class, $actual);
        $this->performAssertions($expected, $actual);
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
        $this->performAssertions($expected, $entities[0]);
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
        $this->performAssertions($expected, $entities[0]);
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
        $this->performAssertions($expected, $actual);
    }

    /**
     * Test that getRepository() method always returns a repository.
     *
     * @return void
     */
    public function testGetRepository(): void
    {
        /** @noinspection UnnecessaryAssertionInspection Testing that getRepository() always returns a repository  */
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
        self::assertSame($expected->getUserId(), $actual->getUserId());
        self::assertSame('updated@email.test', $actual->getEmail());
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
        return new EoneoPayApiManager(new SdkManagerStub($entity));
    }

    /**
     * Perform assertions.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $expected
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $actual
     *
     * @return void
     */
    private function performAssertions(EntityInterface $expected, EntityInterface $actual): void
    {
        self::assertSame($expected->getEntityId(), $actual->getEntityId());
    }
}
