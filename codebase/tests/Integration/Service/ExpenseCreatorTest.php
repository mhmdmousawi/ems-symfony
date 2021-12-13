<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service;

use App\Service\ExpenseCreator;
use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExpenseCreatorTest extends WebTestCase
{
    use ProphecyTrait;
    use FixturesTrait;

    private ReferenceRepository $fixtureRepository;
    private ObjectManager|ObjectProphecy $objectManager;
    private ExpenseCreator $expenseCreator;

    protected function setUp(): void
    {
        parent::setUp();

        $container = $this->getContainer();
        $this->fixtureRepository = new ProxyReferenceRepository($container->get('doctrine')->getManager());

        $managerRegistry = $this->prophesize(ManagerRegistry::class);
        $this->objectManager = $this->prophesize(ObjectManager::class);
        $this->expenseCreator = new ExpenseCreator($managerRegistry->reveal());
    }

    public function testCreate(): void
    {
        //@TODO fix fixture retrieval by reference name
//        $expenseType = $this->fixtureRepository->getReference(ExpenseTypeData::EXPENSE_TYPE_REF_1);
//        $createExpenseRequestDTO = new CreateExpenseRequestDTO();
//        $createExpenseRequestDTO
//            ->setValue(1)
//            ->setDescription('Test Description');
//            ->setTypeId($expenseType->getId());
//
//        $expense = $this->expenseCreator->create($createExpenseRequestDTO, $expenseType);
//
//        $this->assertInstanceOf(ExpenseType::class, $expense->getType());
//        $this->assertEquals($expenseType->getId(), $expense->getType()->getId());
    }
}
