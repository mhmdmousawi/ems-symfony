<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Request\CreateExpenseRequestDTO;
use App\Entity\Expense;
use App\Entity\ExpenseType;
use Doctrine\Persistence\ManagerRegistry;

class ExpenseCreator
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function create(CreateExpenseRequestDTO $createExpenseRequestDTO, ExpenseType $expenseType): Expense
    {
        $entityManager = $this->managerRegistry->getManager();

        $expense = new Expense();
        $expense
            ->setValue($createExpenseRequestDTO->getValue())
            ->setDescription($createExpenseRequestDTO->getDescription())
            ->setType($expenseType)
            ->setCreatedAt(time())
            ->setUpdatedAt(time());

        dump($expenseType);
        $entityManager->persist($expense);
        $entityManager->flush();

        return $expense;
    }
}
