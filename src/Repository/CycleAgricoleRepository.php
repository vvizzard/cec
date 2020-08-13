<?php

namespace App\Repository;

use App\Entity\CycleAgricole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CycleAgricole|null find($id, $lockMode = null, $lockVersion = null)
 * @method CycleAgricole|null findOneBy(array $criteria, array $orderBy = null)
 * @method CycleAgricole[]    findAll()
 * @method CycleAgricole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CycleAgricoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CycleAgricole::class);
    }

    // /**
    //  * @return CycleAgricole[] Returns an array of CycleAgricole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CycleAgricole
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
