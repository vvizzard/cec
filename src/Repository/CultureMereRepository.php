<?php

namespace App\Repository;

use App\Entity\CultureMere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CultureMere|null find($id, $lockMode = null, $lockVersion = null)
 * @method CultureMere|null findOneBy(array $criteria, array $orderBy = null)
 * @method CultureMere[]    findAll()
 * @method CultureMere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CultureMereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CultureMere::class);
    }

    // /**
    //  * @return CultureMere[] Returns an array of CultureMere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CultureMere
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
