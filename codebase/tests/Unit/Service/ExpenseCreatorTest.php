<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service;

use App\DTO\Request\CreateExpenseRequestDTO;
use App\Entity\Expense;
use App\Entity\ExpenseType;
use App\Service\ExpenseCreator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @covers \App\Service\ExpenseCreator
 */
class ExpenseCreatorTest extends TestCase
{
    use ProphecyTrait;

    private ManagerRegistry|ObjectProphecy $managerRegistry;
    private ObjectManager|ObjectProphecy $objectManager;
    private ExpenseCreator $expenseCreator;

    protected function setUp(): void
    {
        $this->managerRegistry = $this->prophesize(ManagerRegistry::class);
        $this->objectManager = $this->prophesize(ObjectManager::class);
        $this->expenseCreator = new ExpenseCreator($this->managerRegistry->reveal());
    }

    public function testCreate(): void
    {
        $this->objectManager->persist(Argument::type(Expense::class))->shouldBeCalled();
        $this->objectManager->flush()->shouldBeCalled();
        $this->managerRegistry->getManager()->willReturn($this->objectManager)->shouldBeCalled();

        $expenseType = new ExpenseType(1);
        $createExpenseRequestDTO = new CreateExpenseRequestDTO();
        $createExpenseRequestDTO
            ->setValue(1)
            ->setDescription('Test Description')
            ->setTypeId(1);

        $expense = $this->expenseCreator->create($createExpenseRequestDTO, $expenseType);

        $this->assertEquals(1, $expense->getValue());
        $this->assertEquals('Test Description', $expense->getDescription());
        $this->assertEquals(1, $expense->getType()->getId());
    }
}
