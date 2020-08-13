<?php

namespace App\Repository;

use App\Entity\NbrFumureCultureM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NbrFumureCultureM|null find($id, $lockMode = null, $lockVersion = null)
 * @method NbrFumureCultureM|null findOneBy(array $criteria, array $orderBy = null)
 * @method NbrFumureCultureM[]    findAll()
 * @method NbrFumureCultureM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NbrFumureCultureMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NbrFumureCultureM::class);
    }

    // /**
    //  * @return NbrFumureCultureM[] Returns an array of NbrFumureCultureM objects
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
    public function findOneBySomeField($value): ?NbrFumureCultureM
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
