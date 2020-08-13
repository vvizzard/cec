<?php

namespace App\Repository;

use App\Entity\TypeSol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeSol|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeSol|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeSol[]    findAll()
 * @method TypeSol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeSolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeSol::class);
    }

    // /**
    //  * @return TypeSol[] Returns an array of TypeSol objects
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
    public function findOneBySomeField($value): ?TypeSol
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
