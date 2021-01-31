<?php
declare(strict_types=1);

namespace App\Request;

use App\Response\ErrorDetailsContainerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class RequestValidationError extends BadRequestHttpException implements ErrorDetailsContainerInterface
{
    private ConstraintViolationListInterface $errors;

    public function __construct(ConstraintViolationListInterface $errors)
    {
        parent::__construct('Invalid request body was given.');

        $this->errors = $errors;
    }

    public function getErrorDetails(): array
    {
        return array_map(
            fn(ConstraintViolationInterface $error) => [
                'field' => $error->getPropertyPath(),
                'error' => $error->getMessage(),
            ],
            iterator_to_array($this->errors)
        );
    }
}
