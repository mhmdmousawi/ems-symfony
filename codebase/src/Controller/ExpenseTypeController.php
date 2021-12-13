<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTOFactory\Response\ExpenseTypeResponseDTOFactory;
use App\Repository\ExpenseTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/expense-types')]
class ExpenseTypeController extends AbstractController
{
    private ExpenseTypeRepository $expenseTypeRepository;
    private ExpenseTypeResponseDTOFactory $expenseTypeResponseDTOFactory;

    public function __construct(
        ExpenseTypeRepository $expenseTypeRepository,
        ExpenseTypeResponseDTOFactory $expenseTypeResponseDTOFactory
    ) {
        $this->expenseTypeRepository = $expenseTypeRepository;
        $this->expenseTypeResponseDTOFactory = $expenseTypeResponseDTOFactory;
    }

    #[Route(path: '', methods: ['GET'])]
    public function getAllExpenseTypesAction(): Response
    {
        return $this->json(
            $this->expenseTypeResponseDTOFactory->createDTOs($this->expenseTypeRepository->findAll()),
            Response::HTTP_OK
        );
    }
}
