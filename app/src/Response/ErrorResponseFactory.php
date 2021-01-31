<?php
declare(strict_types=1);

namespace App\Response;

use App\Response\Dto\Error;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorResponseFactory
{
    public function createResponseFromException(\Throwable $exception): Response
    {
        return new JsonResponse(
            new Error($exception->getMessage(), $this->extractDetails($exception)),
            $this->extractStatusCode($exception)
        );
    }

    private function extractStatusCode(\Throwable $exception): int
    {
        switch (true) {
            case $exception instanceof HttpException:
                return $exception->getStatusCode();
            default:
                return Response::HTTP_INTERNAL_SERVER_ERROR;
        }
    }

    private function extractDetails(\Throwable $exception): array
    {
        switch (true) {
            case $exception instanceof ErrorDetailsContainerInterface:
                return $exception->getErrorDetails();
            default:
                return [];
        }
    }
}
