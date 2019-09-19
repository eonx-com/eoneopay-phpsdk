<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk;

use EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface;
use EoneoPay\PhpSdk\Interfaces\RepositoryInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;

class Repository implements RepositoryInterface
{
    /**
     * EoneoPay api manager.
     *
     * @var \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface
     */
    private $apiManager;

    /**
     * Entity class name.
     *
     * @var string
     */
    private $entityClass;

    /**
     * Construct default repository.
     *
     * @param \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface $apiManager
     * @param string $entityClass
     */
    public function __construct(EoneoPayApiManagerInterface $apiManager, string $entityClass)
    {
        $this->apiManager = $apiManager;
        $this->entityClass = $entityClass;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(string $apikey): array
    {
        return $this->getApiManager()->findAll($this->entityClass, $apikey);
    }

    /**
     * {@inheritdoc}
     */
    public function findById(string $entityId, string $apikey): EntityInterface
    {
        return $this->getApiManager()->find($this->entityClass, $entityId, $apikey);
    }

    /**
     * Get api manager.
     *
     * @return \EoneoPay\PhpSdk\Interfaces\EoneoPayApiManagerInterface
     */
    protected function getApiManager(): EoneoPayApiManagerInterface
    {
        return $this->apiManager;
    }
}
