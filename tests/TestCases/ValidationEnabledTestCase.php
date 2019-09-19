<?php
declare(strict_types=1);

namespace Tests\EoneoPay\PhpSdk\TestCases;

use EoneoPay\Utils\AnnotationReader;
use EoneoPay\Utils\Interfaces\Exceptions\ValidationExceptionInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidatorFactory;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Tests\EoneoPay\PhpSdk\Stubs\Vendor\Symfony\Translator\TranslatorStub;
use Tests\EoneoPay\PhpSdk\Stubs\Vendor\Symfony\Validator\ValidatorStub;
use Tests\EoneoPay\PhpSdk\TestCase;

/**
 * @coversNothing
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects) High coupling required to fully test.
 */
class ValidationEnabledTestCase extends TestCase
{
    /**
     * The validator instance.
     *
     * @var \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    private $validator;

    /**
     * Asserts that the violation list results in a given string output.
     *
     * @param string $expected
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface $violationList
     *
     * @return void
     */
    protected function assertConstraints(string $expected, ConstraintViolationListInterface $violationList): void
    {
        $toString = [$violationList, '__toString'];

        if (\is_callable($toString) === false) {
            self::fail('No __toString() method is available on the violation list');
        }

        self::assertSame($expected, $toString());
    }

    /**
     * Asserts that the validation exception contains the specified validation error messages.
     *
     * @param \EoneoPay\Utils\Interfaces\Exceptions\ValidationExceptionInterface $exception
     * @param string[] $expected
     *
     * @return void
     */
    protected function assertValidationExceptionErrors(
        ValidationExceptionInterface $exception,
        array $expected
    ): void {
        self::assertSame($expected, $exception->getErrors());
    }

    /**
     * Builds an execution context to use in tests.
     *
     * @param \Symfony\Component\Validator\Constraint $constraint
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface|null $validator
     *
     * @return \Symfony\Component\Validator\Context\ExecutionContextInterface
     */
    protected function buildContext(
        Constraint $constraint,
        ?ValidatorInterface $validator = null
    ): ExecutionContextInterface {
        $translator = new TranslatorStub();

        $context = new ExecutionContext(
            $validator ?? new ValidatorStub(),
            'root',
            $translator
        );

        $context->setConstraint($constraint);

        return $context;
    }

    /**
     * Gets a validator instance to use within tests.
     *
     * @return \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    protected function getValidator(): ValidatorInterface
    {
        if (($this->validator instanceof ValidatorInterface) === false) {
            $constraintFactory = new ConstraintValidatorFactory();

            try {
                $reader = new AnnotationReader();

                $this->validator = Validation::createValidatorBuilder()
                    ->enableAnnotationMapping($reader)
                    ->setConstraintValidatorFactory($constraintFactory)
                    ->getValidator();
            } catch (\Exception $exception) {
                self::fail(\sprintf('Could not create validator instance: %s', $exception->getMessage()));
            }
        }

        return $this->validator;
    }
}
