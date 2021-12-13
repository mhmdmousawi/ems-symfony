<?php

declare(strict_types=1);

namespace App\Tests\Unit\DTOFactory\Response;

use App\DTO\Response\ExpenseTypeResponseDTO;
use App\DTOFactory\Response\ExpenseDetailsResponseDTOFactory;
use App\DTOFactory\Response\ExpenseTypeResponseDTOFactory;
use App\Entity\Expense;
use App\Entity\ExpenseType;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @covers \App\DTOFactory\Response\ExpenseDetailsResponseDTOFactory
 */
class ExpenseDetailsResponseDTOFactoryTest extends TestCase
{
    use ProphecyTrait;

    private ExpenseTypeResponseDTOFactory|ObjectProphecy $expenseTypeResponseDTOFactory;

    protected function setUp(): void
    {
        $this->expenseTypeResponseDTOFactory = $this->prophesize(ExpenseTypeResponseDTOFactory::class);
    }

    public function testCreateDTO(): void
    {

        $expenseTypeResponseDTO = new ExpenseTypeResponseDTO();
        $expenseTypeResponseDTO->setId(10)->setName("name");

        $expenseType = new ExpenseType(10);
        $expense = new Expense(20);
        $expense
            ->setValue(100)
            ->setDescription('test desc')
            ->setType($expenseType)
            ->setUpdatedAt(1639339255)
            ->setCreatedAt(1639339254);

        $this->expenseTypeResponseDTOFactory->createDTO($expenseType)
            ->shouldBeCalled()
            ->willReturn($expenseTypeResponseDTO);

        $expenseDetailsResponseDTOFactory = new ExpenseDetailsResponseDTOFactory(
            $this->expenseTypeResponseDTOFactory->reveal()
        );

        $expenseDetailsResponseDTO = $expenseDetailsResponseDTOFactory->createDTO($expense);

        $this->assertEquals(100, $expenseDetailsResponseDTO->getValue());
        $this->assertEquals('test desc', $expenseDetailsResponseDTO->getDescription());
        $this->assertEquals(1639339255, $expenseDetailsResponseDTO->getUpdatedAt());
        $this->assertEquals(1639339254, $expenseDetailsResponseDTO->getCreatedAt());
        $this->assertEquals(10, $expenseDetailsResponseDTO->getType()->getId());
    }
}
