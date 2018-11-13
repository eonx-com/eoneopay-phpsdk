<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk;

use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Parse errors and get the error message array.
     *
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface $errors
     *
     * @return string[]|null
     */
    protected function parseValidationErrors(ConstraintViolationListInterface $errors): ?array
    {
        $messages = null;

        /** @var \Symfony\Component\Validator\ConstraintViolation $error */
        foreach ($errors as $error) {
            $messages[$error->getPropertyPath()] = $error->getMessage();
        }

        return $messages;
    }

    /**
     * Generate a unique id with an optional prefix
     *
     * @param string|null $prefix The prefix to use when generating the id
     *
     * @return string
     */
    protected function generateId(?string $prefix = null): string
    {
        /** @noinspection ArgumentEqualsDefaultValueInspection EA inspections require both parameters to be passed */
        return \uniqid($prefix ?? '', false);
    }
}
