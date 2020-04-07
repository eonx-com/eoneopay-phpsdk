<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Entities;

use EoneoPay\PhpSdk\Interfaces\Endpoints\VersionedEndpointInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @coversNothing
 */
class V2EntityStub extends Entity implements VersionedEndpointInterface
{
    /**
     * {@inheritdoc}
     */
    public function getVersion(): int
    {
        return 2;
    }

    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/v2/test',
            self::DELETE => '/v2/test',
            self::GET => '/v2/test',
            self::LIST => '/v2/test',
            self::UPDATE => '/v2/test',
        ];
    }
}
