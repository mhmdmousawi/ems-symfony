<?php

declare(strict_types=1);

namespace App\DTO\Response;

class ExpenseResponseDTO
{
    private int $id;
    private float $value;
    private ?string $description;
    private ExpenseTypeResponseDTO $type;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ExpenseTypeResponseDTO
    {
        return $this->type;
    }

    public function setType(ExpenseTypeResponseDTO $type): self
    {
        $this->type = $type;

        return $this;
    }
}
