<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ExpenseType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExpenseType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExpenseType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExpenseType[]    findAll()
 * @method ExpenseType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpenseTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExpenseType::class);
    }
}
