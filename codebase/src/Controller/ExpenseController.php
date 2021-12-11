<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/expenses')]
class ExpenseController extends AbstractController
{
    #[Route(path: '', methods: ['GET'])]
    public function getAllExpensesAction(): Response
    {
        //@TODO Add actual logic

        return $this->json([
            'expenses' => [
                ['id' => 1],
                ['id' => 2]
            ]
        ], Response::HTTP_OK);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getExpenseAction(int $id): Response
    {
        //@TODO Add actual logic

        return $this->json(['id' => $id], Response::HTTP_OK);
    }

    #[Route(
        path: '',
        methods: ['POST']
    )]
    public function createExpenseAction(Request $request): Response
    {
        //@TODO Add actual logic
        $data = json_decode($request->getContent(), true);

        return $this->json($data, Response::HTTP_CREATED);
    }

    #[Route(
        path: '/{id}',
        methods: ['PUT']
    )]
    public function updateExpenseAction(Request $request, int $id): Response
    {
        //@TODO Add actual logic
        $data = json_decode($request->getContent(), true);

        return $this->json([$data, $id], Response::HTTP_OK);
    }

    #[Route(
        path: '/{id}',
        methods: ['DELETE']
    )]
    public function deleteExpenseAction(int $id): Response
    {
        //@TODO Add actual logic

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
