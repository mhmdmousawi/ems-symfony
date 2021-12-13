<?php

declare(strict_types=1);

namespace App\DTOFactory\Response;

use App\DTO\Response\ExpenseDetailsResponseDTO;
use App\Entity\Expense;

class ExpenseDetailsResponseDTOFactory
{
    private ExpenseTypeResponseDTOFactory $expenseTypeResponseDTOFactory;

    public function __construct(ExpenseTypeResponseDTOFactory $expenseTypeResponseDTOFactory)
    {
        $this->expenseTypeResponseDTOFactory = $expenseTypeResponseDTOFactory;
    }

    public function createDTO(Expense $expense): ExpenseDetailsResponseDTO
    {
        $expenseDetailsResponseDTO = new ExpenseDetailsResponseDTO();
        $expenseDetailsResponseDTO
            ->setId($expense->getId())
            ->setValue($expense->getValue())
            ->setDescription($expense->getDescription())
            ->setType($this->expenseTypeResponseDTOFactory->createDTO($expense->getType()))
            ->setUpdatedAt($expense->getUpdatedAt())
            ->setCreatedAt($expense->getCreatedAt());

        return $expenseDetailsResponseDTO;
    }
}
