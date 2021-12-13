<?php

declare(strict_types=1);

namespace App\DTOFactory\Response;

use App\DTO\Response\ExpenseResponseDTO;
use App\Entity\Expense;

class ExpenseResponseDTOFactory
{
    private ExpenseTypeResponseDTOFactory $expenseTypeResponseDTOFactory;

    public function __construct(ExpenseTypeResponseDTOFactory $expenseTypeResponseDTOFactory)
    {
        $this->expenseTypeResponseDTOFactory = $expenseTypeResponseDTOFactory;
    }

    /**
     * @param Expense[] $expenses
     *
     * @return ExpenseResponseDTO[]
     */
    public function createDTOs(array $expenses): array
    {
        return array_map(
            function (Expense $expense) {
                return $this->createDTO($expense);
            },
            $expenses
        );
    }

    public function createDTO(Expense $expense): ExpenseResponseDTO
    {
        $expenseResponseDTO = new ExpenseResponseDTO();
        $expenseResponseDTO
            ->setId($expense->getId())
            ->setValue($expense->getValue())
            ->setDescription($expense->getDescription())
            ->setType($this->expenseTypeResponseDTOFactory->createDTO($expense->getType()));

        return $expenseResponseDTO;
    }
}
