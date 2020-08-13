<?php

namespace App\Repository;

use App\Entity\SystemeCultural;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SystemeCultural|null find($id, $lockMode = null, $lockVersion = null)
 * @method SystemeCultural|null findOneBy(array $criteria, array $orderBy = null)
 * @method SystemeCultural[]    findAll()
 * @method SystemeCultural[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SystemeCulturalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SystemeCultural::class);
    }

    // /**
    //  * @return SystemeCultural[] Returns an array of SystemeCultural objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SystemeCultural
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
