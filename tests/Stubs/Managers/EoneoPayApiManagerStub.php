<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Managers;

use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\RepositoryInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use Tests\EoneoPay\PhpSdk\Stubs\Repositories\RepositorySub;

final class EoneoPayApiManagerStub implements EoneoPayApiManagerInterface
{
    /**
     * @var \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface|null
     */
    private $entity;

    /**
     * EoneoPayApiManagerStub constructor.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface|null $entity
     */
    public function __construct(?EntityInterface $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * @inheritdoc
     */
    public function create(string $apikey, EntityInterface $entity): EntityInterface
    {
        return $this->entity ?? $entity;
    }

    /**
     * @inheritdoc
     */
    public function delete(string $apikey, EntityInterface $entity): ?EntityInterface
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function find(string $entityName, string $apikey, string $entityId): EntityInterface
    {
        return $this->entity ?? new $entityName();
    }

    /**
     * @inheritdoc
     */
    public function findAll(string $entityName, string $apikey): array
    {
        return [$this->entity];
    }

    /**
     * @inheritdoc
     */
    public function findBy(string $entityName, string $apikey, array $criteria): array
    {
        return [$this->entity ?? new $entityName($criteria)];
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(string $entityName, string $apikey, array $criteria): EntityInterface
    {
        return $this->entity ?? new $entityName($criteria);
    }

    /**
     * @inheritdoc
     */
    public function getRepository(string $entityClass): RepositoryInterface
    {
        return new RepositorySub($this, $entityClass);
    }

    /**
     * @inheritdoc
     */
    public function update(string $apikey, EntityInterface $entity): EntityInterface
    {
        return $this->entity ?? $entity;
    }
}
