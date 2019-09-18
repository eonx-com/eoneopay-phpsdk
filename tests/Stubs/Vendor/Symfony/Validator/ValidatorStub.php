<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\Stubs\Vendor\Symfony\Validator;

use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @coversNothing
 */
class ValidatorStub implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getMetadataFor($value)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function hasMetadataFor($value)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function inContext(ExecutionContextInterface $context)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function startContext()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, $constraints = null, $groups = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function validateProperty($object, $propertyName, $groups = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function validatePropertyValue($objectOrClass, $propertyName, $value, $groups = null)
    {
    }
}
