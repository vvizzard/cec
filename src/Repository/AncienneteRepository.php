<?php

namespace App\Repository;

use App\Entity\Anciennete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Anciennete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anciennete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anciennete[]    findAll()
 * @method Anciennete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AncienneteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anciennete::class);
    }

    // /**
    //  * @return Anciennete[] Returns an array of Anciennete objects
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
    public function findOneBySomeField($value): ?Anciennete
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
