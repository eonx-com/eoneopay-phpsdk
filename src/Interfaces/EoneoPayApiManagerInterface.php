<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;

interface EoneoPayApiManagerInterface
{
    /**
     * @inheritdoc
     */
    public function create(string $apikey, EntityInterface $entity): EntityInterface;

    /**
     * @inheritdoc
     */
    public function delete(string $apikey, EntityInterface $entity): bool;

    /**
     * @inheritdoc
     */
    public function find(string $entityName, string $apikey, string $entityId): EntityInterface;

    /**
     * @inheritdoc
     */
    public function findAll(string $entityName, string $apikey): array;

    /**
     * @inheritdoc
     */
    public function findBy(string $entityName, string $apikey, array $criteria): array;

    /**
     * @inheritdoc
     */
    public function findOneBy(string $entityName, string $apikey, array $criteria): EntityInterface;

    /**
     * @inheritdoc
     */
    public function getRepository(string $entityClass): RepositoryInterface;

    /**
     * @inheritdoc
     */
    public function update(string $apikey, EntityInterface $entity): EntityInterface;
}
