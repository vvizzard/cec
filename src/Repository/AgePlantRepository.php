<?php

namespace App\Repository;

use App\Entity\AgePlant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AgePlant|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgePlant|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgePlant[]    findAll()
 * @method AgePlant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgePlantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgePlant::class);
    }

    // /**
    //  * @return AgePlant[] Returns an array of AgePlant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AgePlant
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
