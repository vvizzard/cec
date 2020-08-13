<?php

namespace App\Repository;

use App\Entity\NbrCultureAgriculteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NbrCultureAgriculteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method NbrCultureAgriculteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method NbrCultureAgriculteur[]    findAll()
 * @method NbrCultureAgriculteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NbrCultureAgriculteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NbrCultureAgriculteur::class);
    }

    // /**
    //  * @return NbrCultureAgriculteur[] Returns an array of NbrCultureAgriculteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NbrCultureAgriculteur
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
