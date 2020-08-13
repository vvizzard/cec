<?php

namespace App\Repository;

use App\Entity\CultureFille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CultureFille|null find($id, $lockMode = null, $lockVersion = null)
 * @method CultureFille|null findOneBy(array $criteria, array $orderBy = null)
 * @method CultureFille[]    findAll()
 * @method CultureFille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CultureFilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CultureFille::class);
    }

    // /**
    //  * @return CultureFille[] Returns an array of CultureFille objects
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
    public function findOneBySomeField($value): ?CultureFille
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
