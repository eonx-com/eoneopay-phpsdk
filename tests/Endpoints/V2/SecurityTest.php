<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Endpoints\V2;

use EoneoPay\PhpSdk\Endpoints\V2\Security;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @covers \EoneoPay\PhpSdk\Endpoints\V2\Security
 */
class SecurityTest extends TestCase
{
    /**
     * Tests uris
     *
     * @return void
     */
    public function testUris(): void
    {
        $security = new Security();

        self::assertSame([], $security->uris());
    }
}
