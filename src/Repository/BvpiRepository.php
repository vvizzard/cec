<?php

namespace App\Repository;

use App\Entity\Bvpi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bvpi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bvpi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bvpi[]    findAll()
 * @method Bvpi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BvpiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bvpi::class);
    }

    // /**
    //  * @return Bvpi[] Returns an array of Bvpi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bvpi
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
