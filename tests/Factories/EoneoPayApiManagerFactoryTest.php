<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Factories;

use EoneoPay\PhpSdk\Factories\EoneoPayApiManagerFactory;
use EoneoPay\PhpSdk\Managers\EoneoPayApiManager;
use ReflectionClass;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Factories\EoneoPayApiManagerFactory
 */
final class EoneoPayApiManagerFactoryTest extends TestCase
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
            (new EoneoPayApiManagerFactory())->create('http://localhost')
        );
    }

    /**
     * Test create EoneoPay api manager with headers successfully.
     *
     * @return void
     *
     * @throws \ReflectionException If something goes horribly wrong
     */
    public function testCreateWithHeaders(): void
    {
        $factory = new EoneoPayApiManagerFactory();
        $instance = $factory->create('http://localhost', ['X-Test' => 'testing']);

        self::assertInstanceOf(
            EoneoPayApiManager::class,
            $instance
        );

        // Expose guzzle client and check for headers
        $reflected = new ReflectionClass($instance);
        $reflectedManager = $reflected->getProperty('sdkManager');
        $reflectedManager->setAccessible(true);
        $manager = $reflectedManager->getValue($instance);

        $reflected = new ReflectionClass($manager);
        $reflectedHandler = $reflected->getProperty('requestHandler');
        $reflectedHandler->setAccessible(true);
        $handler = $reflectedHandler->getValue($manager);

        $reflected = new ReflectionClass($handler);
        $reflectedClient = $reflected->getProperty('httpClient');
        $reflectedClient->setAccessible(true);
        $guzzle = $reflectedClient->getValue($handler);

        $headers = $guzzle->getConfig('headers');
        self::assertSame(['X-Test', 'User-Agent'], \array_keys($headers));
    }
}
