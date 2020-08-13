<?php

namespace App\Repository;

use App\Entity\DegatCyclonique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DegatCyclonique|null find($id, $lockMode = null, $lockVersion = null)
 * @method DegatCyclonique|null findOneBy(array $criteria, array $orderBy = null)
 * @method DegatCyclonique[]    findAll()
 * @method DegatCyclonique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DegatCycloniqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DegatCyclonique::class);
    }

    // /**
    //  * @return DegatCyclonique[] Returns an array of DegatCyclonique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DegatCyclonique
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
