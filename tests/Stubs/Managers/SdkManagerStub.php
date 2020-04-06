<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Managers;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\EntityInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestAwareInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\SdkManagerInterface;

final class SdkManagerStub implements SdkManagerInterface
{
    /**
     * @var mixed[]|null
     */
    private $calls;

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
     * {@inheritdoc}
     */
    public function execute(EntityInterface $entity, string $action, ?string $apikey = null, ?array $headers = null)
    {
        $this->calls[__FUNCTION__][] = \compact('entity', 'action', 'apikey', 'headers');

        if (\mb_strtolower($action) === RequestAwareInterface::LIST) {
            return [$this->entity ?? $entity];
        }

        return $this->entity ?? $entity;
    }

    /**
     * Get calls made to execute.
     *
     * @param string $method
     *
     * @return mixed[]|null
     */
    public function getCalls(string $method): ?array
    {
        return $this->calls[$method] ?? [];
    }
}
