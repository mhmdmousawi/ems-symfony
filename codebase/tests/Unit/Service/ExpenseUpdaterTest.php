<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\DTO\Request\UpdateExpenseRequestDTO;
use App\Entity\Expense;
use App\Entity\ExpenseType;
use App\Service\ExpenseUpdater;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @covers \App\Service\ExpenseUpdater
 */
class ExpenseUpdaterTest extends TestCase
{
    use ProphecyTrait;

    private ManagerRegistry|ObjectProphecy $managerRegistry;
    private ObjectManager|ObjectProphecy $objectManager;
    private ExpenseUpdater $expenseUpdater;

    protected function setUp(): void
    {
        $this->managerRegistry = $this->prophesize(ManagerRegistry::class);
        $this->objectManager = $this->prophesize(ObjectManager::class);
        $this->expenseUpdater = new ExpenseUpdater($this->managerRegistry->reveal());
    }

    public function testCreate(): void
    {
        $this->objectManager->persist(Argument::type(Expense::class))->shouldBeCalled();
        $this->objectManager->flush()->shouldBeCalled();
        $this->managerRegistry->getManager()->willReturn($this->objectManager)->shouldBeCalled();

        $expenseType = new ExpenseType(2);
        $expense = new Expense(2);
        $expense->setValue(100);

        $updateExpenseRequestDTO = new UpdateExpenseRequestDTO();
        $updateExpenseRequestDTO
            ->setValue(2)
            ->setDescription('Test Description 2')
            ->setTypeId(2);

        $expenseResult = $this->expenseUpdater->update($updateExpenseRequestDTO, $expense, $expenseType);

        $this->assertEquals(2, $expenseResult->getValue());
        $this->assertEquals('Test Description 2', $expenseResult->getDescription());
        $this->assertEquals(2, $expenseResult->getType()->getId());
        $this->assertEquals($expense->getId(), $expenseResult->getId());
    }
}
