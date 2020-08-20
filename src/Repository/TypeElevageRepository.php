<?php

namespace App\Repository;

use App\Entity\TypeElevage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeElevage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeElevage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeElevage[]    findAll()
 * @method TypeElevage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeElevageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeElevage::class);
    }

    // /**
    //  * @return TypeElevage[] Returns an array of TypeElevage objects
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
    public function findOneBySomeField($value): ?TypeElevage
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
