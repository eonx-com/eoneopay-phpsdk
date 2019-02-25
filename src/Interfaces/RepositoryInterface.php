<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;

interface RepositoryInterface
{
    /**
     * Find all entities.
     *
     * @param string $apikey Api key
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface[]
     */
    public function findAll(string $apikey): array;

    /**
     * Find entity by id.
     *
     * @param string $entityId Entity id
     * @param string $apikey Api key
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function findById(string $entityId, string $apikey): EntityInterface;
}
