<?php

namespace App\DataFixtures;

use App\Entity\ExpenseType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpenseTypeData extends Fixture
{
    const EXPENSE_TYPE_REF_1 = 'expense-type-1';

    public function load(ObjectManager $manager): void
    {
        $expenseType = new ExpenseType();
        $expenseType
            ->setName("Expense Type Name 1")
            ->setCreatedAt(1639339254);

        $manager->persist($expenseType);
        $manager->flush();

        $this->addReference(name: self::EXPENSE_TYPE_REF_1, object: $expenseType);
    }
}
