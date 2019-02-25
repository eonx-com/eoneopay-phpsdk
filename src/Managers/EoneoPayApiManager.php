<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Managers;

use EoneoPay\PhpSdk\Annotations\Repository as RepositoryAnnotation;
use Doctrine\Common\Annotations\AnnotationReader;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\RepositoryInterface;
use EoneoPay\PhpSdk\Repository;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface;

final class EoneoPayApiManager implements EoneoPayApiManagerInterface
{
    /**
     * Sdk Manager.
     *
     * @var \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface
     */
    private $sdkManager;

    /**
     * Construct EoneoPay api manager.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface $sdkManager
     */
    public function __construct(SdkManagerInterface $sdkManager)
    {
        $this->sdkManager = $sdkManager;
    }

    /**
     * @inheritdoc
     */
    public function create(string $apikey, EntityInterface $entity): EntityInterface
    {
        return $this->sdkManager->execute($entity, RequestAwareInterface::CREATE, $apikey);
    }

    /**
     * @inheritdoc
     */
    public function delete(string $apikey, EntityInterface $entity): bool
    {
        $this->sdkManager->execute($entity, RequestAwareInterface::DELETE, $apikey);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function find(string $entityName, string $apikey, string $entityId): EntityInterface
    {
        $entity = new $entityName(['id' => $entityId]);

        return $this->sdkManager->execute($entity, RequestAwareInterface::GET, $apikey);
    }

    /**
     * @inheritdoc
     */
    public function findAll(string $entityName, string $apikey): array
    {
        return $this->sdkManager->execute(new $entityName(), RequestAwareInterface::LIST, $apikey);
    }

    /**
     * @inheritdoc
     */
    public function findBy(string $entityName, string $apikey, array $criteria): array
    {
        $entity = new $entityName($criteria);

        return $this->sdkManager->execute($entity, RequestAwareInterface::LIST, $apikey);
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(string $entityName, string $apikey, array $criteria): EntityInterface
    {
        $entity = new $entityName($criteria);

        return $this->sdkManager->execute($entity, RequestAwareInterface::GET, $apikey);
    }

    /**
     * @inheritdoc
     *
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \ReflectionException
     */
    public function getRepository(string $entityClass): RepositoryInterface
    {
        $reflectionClass = new \ReflectionClass($entityClass);
        $classAnnotations = (new AnnotationReader())->getClassAnnotations($reflectionClass);

        foreach ($classAnnotations as $annotation) {
            if (($annotation instanceof RepositoryAnnotation) === true) {
                return new $annotation->repositoryClass($this, $entityClass);
            }
        }

        if ($reflectionClass->getParentClass() !== false) {
            return $this->getRepository(\get_class($reflectionClass->getParentClass()));
        }

        return new Repository($this, $entityClass);
    }

    /**
     * @inheritdoc
     */
    public function update(string $apikey, EntityInterface $entity): EntityInterface
    {
        return $this->sdkManager->execute($entity, RequestAwareInterface::UPDATE, $apikey);
    }
}
