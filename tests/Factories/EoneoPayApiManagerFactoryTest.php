<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Factories\EoneoPayApiManagerFactory;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Factories\EoneoPayApiManagerFactory
 */
class EoneoPayApiManagerFactoryTest extends TestCase
{
    /**
     * Test create EoneoPay api manager successfully.
     *
     * @return void
     */
    public function testCreate(): void
    {
        self::assertInstanceOf(
            EoneoPayApiManager::class,
            (new EoneoPayApiManagerFactory())->create('http://localhost'));
    }
}
