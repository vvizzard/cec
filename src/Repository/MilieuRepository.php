<?php

namespace App\Repository;

use App\Entity\Milieu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Milieu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Milieu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Milieu[]    findAll()
 * @method Milieu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MilieuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Milieu::class);
    }

    // /**
    //  * @return Milieu[] Returns an array of Milieu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Milieu
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
