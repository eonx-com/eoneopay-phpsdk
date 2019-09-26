<?php
declare(strict_types=1);

namespace EoneoPay\PhpSdk\Services\Webhooks\Exceptions;

use EoneoPay\PhpSdk\Exceptions\ValidationException as BaseValidationException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class WebhookParserValidationException extends BaseValidationException
{
    /**
     * The constraint violations list.
     *
     * @var \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    private $violations;

    /**
     * Constructs a new instance of WebhookPraserValidationException.
     *
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface $violations
     */
    public function __construct(ConstraintViolationListInterface $violations)
    {
        $this->violations = $violations;

        $errors = [];
        foreach ($violations as $violation) {
            /**
             * @var \Symfony\Component\Validator\ConstraintViolationInterface $violation
             */
            $errors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        parent::__construct(
            'The webhook parser failed to validate the parsed entity.',
            null,
            self::DEFAULT_ERROR_CODE_VALIDATION + 200,
            null,
            $errors,
            1
        );
    }

    /**
     * Gets the constraint violations passed in to the exception.
     *
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
