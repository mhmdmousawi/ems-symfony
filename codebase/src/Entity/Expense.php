<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ExpenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpenseRepository::class, readOnly: true)]
#[ORM\Table(name: "expenses")]
class Expense
{
     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column(name: "id", type: "integer", nullable: false)]
     private int $id;

    #[ORM\Column(name: "value", type: "float", nullable: false)]
    private float $value;

    #[ORM\Column(name: "description", type: "string", nullable: true)]
    private ?string $description;

    #[ORM\OneToOne(targetEntity: ExpenseType::class)]
    #[ORM\JoinColumn(name: "type_id", referencedColumnName: "id")]
    private ExpenseType $type;

    #[ORM\Column(name: "created_at", type: "integer", nullable: false)]
    private int $createdAt;

    #[ORM\Column(name: "updated_at", type: "integer", nullable: false)]
    private int $updatedAt;

    public function __construct(?int $id = null)
    {
        if ($id) {
            $this->id = $id;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
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

    public function getType(): ExpenseType
    {
        return $this->type;
    }

    public function setType(ExpenseType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(int $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
