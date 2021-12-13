<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Request\UpdateExpenseRequestDTO;
use App\Entity\Expense;
use App\Entity\ExpenseType;
use Doctrine\Persistence\ManagerRegistry;

class ExpenseUpdater
{
    private ManagerRegistry $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry) {
        $this->managerRegistry = $managerRegistry;
    }

    public function update(
        UpdateExpenseRequestDTO $updateExpenseRequestDTO,
        Expense $expense,
        ExpenseType $expenseType
    ): Expense {
        $entityManager = $this->managerRegistry->getManager();

        $expense
            ->setValue($updateExpenseRequestDTO->getValue())
            ->setDescription($updateExpenseRequestDTO->getDescription())
            ->setType($expenseType)
            ->setUpdatedAt(time());

        $entityManager->persist($expense);
        //@TODO check why it is not updating
        $entityManager->flush();

        return $expense;
    }
}
