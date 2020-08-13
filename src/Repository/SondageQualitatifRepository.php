<?php

namespace App\Repository;

use App\Entity\SondageQualitatif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SondageQualitatif|null find($id, $lockMode = null, $lockVersion = null)
 * @method SondageQualitatif|null findOneBy(array $criteria, array $orderBy = null)
 * @method SondageQualitatif[]    findAll()
 * @method SondageQualitatif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SondageQualitatifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SondageQualitatif::class);
    }

    // /**
    //  * @return SondageQualitatif[] Returns an array of SondageQualitatif objects
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
    public function findOneBySomeField($value): ?SondageQualitatif
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
