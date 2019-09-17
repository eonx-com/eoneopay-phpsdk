<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Entities;

use EoneoPay\PhpSdk\Annotations\Repository;
use LoyaltyCorp\SdkBlueprint\Sdk\Entity;

/**
 * @method string|null getEntityId()
 * @method self setEntityId(string $entityId)
 *
 * @Repository(repositoryClass="Tests\EoneoPay\PhpSdk\Stubs\Repositories\ParentRepositoryStub")
 */
abstract class ParentCustomRepositoryStub extends Entity
{
    /**
     * {@inheritdoc}
     */
    public function uris(): array
    {
        return [
            self::CREATE => '/test',
            self::DELETE => '/test',
            self::GET => '/test',
            self::LIST => '/test',
            self::UPDATE => '/test',
        ];
    }
}
