<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Interfaces;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;

interface EoneoPayApiManagerInterface
{
    /**
     * Create a POST
     *
     * @param string $apikey
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $entity
     *
     * @throws \LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function create(string $apikey, EntityInterface $entity): EntityInterface;

    /**
     * @param string $apikey
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $entity
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     *
     * @return bool
     */
    public function delete(string $apikey, EntityInterface $entity): bool;

    /**
     * @param string $entityName
     * @param string $apikey
     * @param string $entityId
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function find(string $entityName, string $apikey, string $entityId): EntityInterface;

    /**
     * @param string $entityName
     * @param string $apikey
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     *
     * @return mixed[]
     */
    public function findAll(string $entityName, string $apikey): array;

    /**
     * @param string $entityName
     * @param string $apikey
     * @param mixed[] $criteria
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     *
     * @return mixed[]
     */
    public function findBy(string $entityName, string $apikey, array $criteria): array;

    /**
     * Find one
     *
     * @param string $entityName
     * @param string $apikey
     * @param mixed[] $criteria
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function findOneBy(string $entityName, string $apikey, array $criteria): EntityInterface;

    /**
     * @inheritdoc
     */
    public function getRepository(string $entityClass): RepositoryInterface;

    /**
     * @param string $apikey
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $entity
     *
     * @throws \EoneoPay\Utils\Exceptions\BaseException
     * one of ClientException, CriticalException, RuntimeException, ValidationException
     *
     * @return \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface
     */
    public function update(string $apikey, EntityInterface $entity): EntityInterface;
}
