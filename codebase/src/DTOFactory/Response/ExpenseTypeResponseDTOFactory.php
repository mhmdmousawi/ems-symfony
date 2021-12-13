<?php

declare(strict_types=1);

namespace App\DTOFactory\Response;

use App\DTO\Response\ExpenseTypeResponseDTO;
use App\Entity\ExpenseType;

class ExpenseTypeResponseDTOFactory
{
    /**
     * @param ExpenseType[] $expenseTypes
     *
     * @return ExpenseTypeResponseDTO[]
     */
    public function createDTOs(array $expenseTypes): array
    {
        return array_map(
            function (ExpenseType $expenseType) {
                return $this->createDTO($expenseType);
            },
            $expenseTypes
        );
    }

    public function createDTO(ExpenseType $expenseType): ExpenseTypeResponseDTO
    {
        $expenseTypeResponseDTO = new ExpenseTypeResponseDTO();
        $expenseTypeResponseDTO
            ->setId($expenseType->getId())
            ->setName($expenseType->getName());

        return $expenseTypeResponseDTO;
    }
}
