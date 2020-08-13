<?php

namespace App\Repository;

use App\Entity\PrecedentCultural;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrecedentCultural|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrecedentCultural|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrecedentCultural[]    findAll()
 * @method PrecedentCultural[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrecedentCulturalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrecedentCultural::class);
    }

    // /**
    //  * @return PrecedentCultural[] Returns an array of PrecedentCultural objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrecedentCultural
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
