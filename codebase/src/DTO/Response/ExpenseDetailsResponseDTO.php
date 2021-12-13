<?php

declare(strict_types=1);

namespace App\DTO\Response;

use DateTimeImmutable;

class ExpenseDetailsResponseDTO
{
    private int $id;
    private float $value;
    private ?string $description;
    private ExpenseTypeResponseDTO $type;
    private int $createdAt;
    private int $updatedAt;

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

    public function setCreatedAt(int $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(int $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }
}
