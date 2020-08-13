<?php

namespace App\Repository;

use App\Entity\ZC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZC|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZC|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZC[]    findAll()
 * @method ZC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZC::class);
    }

    // /**
    //  * @return ZC[] Returns an array of ZC objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZC
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
