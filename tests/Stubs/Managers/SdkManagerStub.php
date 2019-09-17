<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Managers;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface;

final class SdkManagerStub implements SdkManagerInterface
{
    /**
     * The entity.
     *
     * @var \LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface|null
     */
    private $entity;

    /**
     * SdkManagerStub constructor.
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
    public function execute(EntityInterface $entity, string $action, ?string $apikey = null)
    {
        if (\mb_strtolower($action) === RequestAwareInterface::LIST) {
            return [$this->entity ?? $entity];
        }

        return $this->entity ?? $entity;
    }
}
