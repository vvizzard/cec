<?php

namespace App\Repository;

use App\Entity\TypeSarclage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeSarclage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSarclage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSarclage[]    findAll()
 * @method TypeSarclage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSarclageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSarclage::class);
    }

    // /**
    //  * @return TypeSarclage[] Returns an array of TypeSarclage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeSarclage
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
