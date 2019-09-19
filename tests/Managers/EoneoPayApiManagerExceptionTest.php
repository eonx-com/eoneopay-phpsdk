<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Managers;

use EoneoPay\PhpSdk\Exceptions\CriticalException;
use Tests\EoneoPay\PhpSdk\Stubs\Entities\EntityStub;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Managers\EoneoPayApiManager
 */
final class EoneoPayApiManagerExceptionTest extends TestCase
{
    /**
     * Test if create exception is thrown on invalid response.
     *
     * @return void
     */
    public function testCreateException(): void
    {
        $this->expectException(CriticalException::class);
        $this->createApiManager([
            'code' => 0,
        ], 400)
            ->create(
                'api-key',
                new EntityStub()
            );
    }

    /**
     * Test if delete exception is thrown on invalid response.
     *
     * @return void
     */
    public function testDeleteException(): void
    {
        $this->expectException(CriticalException::class);
        $this->createApiManager([
            'code' => 0,
        ], 400)
            ->delete(
                'api-key',
                new EntityStub()
            );
    }

    /**
     * Test if find exception is thrown on invalid response.
     *
     * @return void
     */
    public function testFindAllException(): void
    {
        $this->expectException(CriticalException::class);
        $this->createApiManager([
            'code' => 0,
        ], 400)
            ->findAll(
                EntityStub::class,
                'api-key'
            );
    }

    /**
     * Test if find exception is thrown on invalid response.
     *
     * @return void
     */
    public function testFindByException(): void
    {
        $this->expectException(CriticalException::class);
        $this->createApiManager([
            'code' => 0,
        ], 400)
            ->findBy(
                EntityStub::class,
                'api-key',
                []
            );
    }

    /**
     * Test if find one by exception is thrown on invalid response.
     *
     * @return void
     */
    public function testFindOneByException(): void
    {
        $this->expectException(CriticalException::class);
        $this->createApiManager([
            'code' => 0,
        ], 400)
            ->findOneBy(
                EntityStub::class,
                'api-key',
                []
            );
    }

    /**
     * Test if update exception is thrown on invalid response.
     *
     * @return void
     */
    public function testUpdateException(): void
    {
        $this->expectException(CriticalException::class);
        $this->createApiManager([
            'code' => 0,
        ], 400)
            ->update(
                'api-key',
                new EntityStub()
            );
    }
}
