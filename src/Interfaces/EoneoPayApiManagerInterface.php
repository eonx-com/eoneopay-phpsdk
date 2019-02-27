<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;

interface EoneoPayApiManagerInterface
{
    /**
     * Request to create a new entity.
     *
     * @param string $apikey Api key
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $entity Entity to be created
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface Created entity
     */
    public function create(string $apikey, EntityInterface $entity): EntityInterface;

    /**
     * Request to delete an entity.
     *
     * @param string $apikey Api key
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $entity Entity to be deleted
     *
     * @return bool
     */
    public function delete(string $apikey, EntityInterface $entity): bool;

    /**
     * Request to find an entity by id.
     *
     * @param string $entityName Entity name to search
     * @param string $apikey Api key
     * @param string $entityId Entity id
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function find(string $entityName, string $apikey, string $entityId): EntityInterface;

    /**
     * Request to find all entities with given entity class.
     *
     * @param string $entityName Entity class name
     * @param string $apikey Api key
     *
     * @return mixed[]
     */
    public function findAll(string $entityName, string $apikey): array;

    /**
     * Request to find entities by give criteria.
     *
     * @param string $entityName Entity class name
     * @param string $apikey Api key
     * @param mixed[] $criteria Search criteria
     *
     * @return mixed[]
     */
    public function findBy(string $entityName, string $apikey, array $criteria): array;

    /**
     * Request to find an entity with given criteria
     *
     * @param string $entityName Entity class name
     * @param string $apikey Api key
     * @param mixed[] $criteria Search criteria
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function findOneBy(string $entityName, string $apikey, array $criteria): EntityInterface;

    /**
     * Get entity repository.
     *
     * @param string $entityClass Entity class name
     *
     * @return \EoneoPay\PhpSdk\Interfaces\RepositoryInterface
     */
    public function getRepository(string $entityClass): RepositoryInterface;

    /**
     * Request to update an entity.
     *
     * @param string $apikey Api key
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $entity Entity to be updated
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface Updated entity
     */
    public function update(string $apikey, EntityInterface $entity): EntityInterface;
}
