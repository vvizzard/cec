<?php

namespace App\Repository;

use App\Entity\EtatMulch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatMulch|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatMulch|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatMulch[]    findAll()
 * @method EtatMulch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatMulchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatMulch::class);
    }

    // /**
    //  * @return EtatMulch[] Returns an array of EtatMulch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtatMulch
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
