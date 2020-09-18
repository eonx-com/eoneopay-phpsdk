<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Managers;

use Doctrine\Common\Annotations\AnnotationReader;
use EoneoPay\PhpSdk\Annotations\Repository as RepositoryAnnotation;
use EoneoPay\PhpSdk\Interfaces\Endpoints\VersionedEndpointInterface;
use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\Factories\ExceptionFactoryInterface;
use EoneoPay\PhpSdk\Interfaces\RepositoryInterface;
use EoneoPay\PhpSdk\Repository;
use LoyaltyCorp\SdkBlueprint\Sdk\Exceptions\InvalidApiResponseException;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface;
use ReflectionClass;
use function sprintf;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects) Main class of package, high coupling required to handle all actions
 */
final class EoneoPayApiManager implements EoneoPayApiManagerInterface
{
    /**
     * Exception Factory.
     *
     * @var \EoneoPay\PhpSdk\Interfaces\Factories\ExceptionFactoryInterface
     */
    private $exceptionFactory;

    /**
     * @var null|int
     */
    private $overrideVersion;

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
     * @param \EoneoPay\PhpSdk\Interfaces\Factories\ExceptionFactoryInterface $exceptionFactory
     * @param null|int $overrideVersion
     */
    public function __construct(
        SdkManagerInterface $sdkManager,
        ExceptionFactoryInterface $exceptionFactory,
        ?int $overrideVersion = null
    ) {
        $this->exceptionFactory = $exceptionFactory;
        $this->sdkManager = $sdkManager;
        $this->overrideVersion = $overrideVersion;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception Exception factory generates a range of exceptions
     */
    public function create(string $apikey, EntityInterface $entity): EntityInterface
    {
        try {
            return $this->sdkManager->execute(
                $entity,
                RequestAwareInterface::CREATE,
                $apikey,
                $this->getHeaders($entity)
            );
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (InvalidApiResponseException $exception) {
            throw $this->exceptionFactory->create($exception);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception Exception factory generates a range of exceptions
     */
    public function delete(string $apikey, EntityInterface $entity): ?EntityInterface
    {
        try {
            return $this->sdkManager->execute(
                $entity,
                RequestAwareInterface::DELETE,
                $apikey,
                $this->getHeaders($entity)
            );
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (InvalidApiResponseException $exception) {
            throw $this->exceptionFactory->create($exception);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception Exception factory generates a range of exceptions
     */
    public function find(string $entityName, string $apikey, string $entityId): EntityInterface
    {
        $entity = new $entityName(['id' => $entityId]);

        try {
            return $this->sdkManager->execute(
                $entity,
                RequestAwareInterface::GET,
                $apikey,
                $this->getHeaders($entity)
            );
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (InvalidApiResponseException $exception) {
            throw $this->exceptionFactory->create($exception);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception Exception factory generates a range of exceptions
     */
    public function findAll(string $entityName, string $apikey): array
    {
        try {
            $entity = new $entityName();

            return $this->sdkManager->execute(
                $entity,
                RequestAwareInterface::LIST,
                $apikey,
                $this->getHeaders($entity)
            );
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (InvalidApiResponseException $exception) {
            throw $this->exceptionFactory->create($exception);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception Exception factory generates a range of exceptions
     */
    public function findBy(string $entityName, string $apikey, array $criteria): array
    {
        $entity = new $entityName($criteria);

        try {
            return $this->sdkManager->execute(
                $entity,
                RequestAwareInterface::LIST,
                $apikey,
                $this->getHeaders($entity)
            );
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (InvalidApiResponseException $exception) {
            throw $this->exceptionFactory->create($exception);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception Exception factory generates a range of exceptions
     */
    public function findOneBy(string $entityName, string $apikey, array $criteria): EntityInterface
    {
        $entity = new $entityName($criteria);

        try {
            return $this->sdkManager->execute(
                $entity,
                RequestAwareInterface::GET,
                $apikey,
                $this->getHeaders($entity)
            );
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (InvalidApiResponseException $exception) {
            throw $this->exceptionFactory->create($exception);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \ReflectionException
     */
    public function getRepository(string $entityClass): RepositoryInterface
    {
        $reflectionClass = new ReflectionClass($entityClass);

        // Attempt to create repository by any means necessary
        return $this->createRepository($entityClass, $reflectionClass) ?? new Repository($this, $entityClass);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception Exception factory generates a range of exceptions
     */
    public function update(string $apikey, EntityInterface $entity): EntityInterface
    {
        try {
            return $this->sdkManager->execute(
                $entity,
                RequestAwareInterface::UPDATE,
                $apikey,
                $this->getHeaders($entity)
            );
        } /** @noinspection PhpRedundantCatchClauseInspection */ catch (InvalidApiResponseException $exception) {
            throw $this->exceptionFactory->create($exception);
        }
    }

    /**
     * Recursively find a repository from an entity or it's parents.
     *
     * @param string $entityClass The original entity class that we are searching for
     * @param \ReflectionClass $reflectionClass
     *
     * @return \EoneoPay\PhpSdk\Interfaces\RepositoryInterface|null
     *
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    private function createRepository(string $entityClass, ReflectionClass $reflectionClass): ?RepositoryInterface
    {
        $annotationReader = new AnnotationReader();

        // Get annotations from the class
        $classAnnotations = $annotationReader->getClassAnnotations($reflectionClass);

        // Loop through annotations and attempt to find a valid repository
        foreach ($classAnnotations as $annotation) {
            // Skip annotations which aren't repository annotations
            if (($annotation instanceof RepositoryAnnotation) === false) {
                continue; // @codeCoverageIgnore
            }

            // Attempt to instantiate repository
            $repositoryClass = $annotation->repositoryClass;
            $repository = new $repositoryClass($this, $entityClass);

            // Only return if the repository implements the correct interface
            if (($repository instanceof RepositoryInterface) === true) {
                return $repository;
            }
        }

        // If repository was not created, attempt to find repository from parent class
        $parent = $reflectionClass->getParentClass();
        if ($parent !== false) {
            return $this->createRepository($entityClass, $parent);
        }

        // No repository found
        return null;
    }

    /**
     * Get headers for entity.
     *
     * @param \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface $entity
     *
     * @return mixed[]|null
     */
    private function getHeaders(EntityInterface $entity): ?array
    {
        if ($this->overrideVersion !== null) {
            return ['Accept' => sprintf('application/vnd.eoneopay.v%s+json', $this->overrideVersion)];
        }

        if ($entity instanceof VersionedEndpointInterface === true) {
            $version = $entity->getVersion();

            return ['Accept' => sprintf('application/vnd.eoneopay.v%s+json', $version)];
        }

        return null;
    }
}
