<?php

namespace App\Repository;

use App\Entity\TypePepiniere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypePepiniere|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePepiniere|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePepiniere[]    findAll()
 * @method TypePepiniere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePepiniereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePepiniere::class);
    }

    // /**
    //  * @return TypePepiniere[] Returns an array of TypePepiniere objects
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
    public function findOneBySomeField($value): ?TypePepiniere
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
