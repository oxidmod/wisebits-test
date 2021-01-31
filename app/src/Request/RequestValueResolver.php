<?php
declare(strict_types=1);

namespace App\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestValueResolver implements ArgumentValueResolverInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        $class = $argument->getType();

        return is_a($class, RequestDtoInterface::class, true);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $class = $argument->getType();

        $result = new $class($request);

        $errors = $this->validator->validate($result);
        if (count($errors) > 0) {
            throw new RequestValidationError($errors);
        }

        yield $result;
    }
}
