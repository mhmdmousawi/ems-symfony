<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

trait ValidationTrait
{
    protected function createValidationErrorView(ConstraintViolationListInterface $validationErrors): Response
    {
        return $this->json(['errors' => $this->buildValidationErrors($validationErrors),], Response::HTTP_BAD_REQUEST);
    }

    protected function buildValidationErrors(ConstraintViolationListInterface $validationErrors): array
    {
        $errors = [];

        /** @var ConstraintViolationInterface $validationError */
        foreach ($validationErrors as $validationError) {
            $errors[] = [
                'property' => $validationError->getPropertyPath(),
                'message' => $validationError->getMessage(),
            ];
        }

        return $errors;
    }

    protected function createGenericErrorView(?string $message, int $statusCode = Response::HTTP_BAD_REQUEST): Response
    {
        $error = [
            'errors' => [
                ['message' => $message],
            ],
        ];

        return $this->json($error, $statusCode);
    }
}
