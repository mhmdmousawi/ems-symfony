<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Expense;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExpenseData extends Fixture implements OrderedFixtureInterface
{
    protected $fixtures = [
        ExpenseTypeData::class
    ];

    public function load(ObjectManager $manager): void
    {
        $expense = new Expense();
        $expense
            ->setValue(100.1)
            ->setDescription("Description test 1")
            ->setType($this->getReference(name: "expense-type-1"))
            ->setCreatedAt(1639338981)
            ->setUpdatedAt(1639339254);

        $manager->persist($expense);
        $manager->flush();

        $this->addReference(name: 'expense-1', object: $expense);
    }

    public function getOrder()
    {
        return 2;
    }
}
