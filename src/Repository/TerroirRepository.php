<?php

namespace App\Repository;

use App\Entity\Terroir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Terroir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Terroir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Terroir[]    findAll()
 * @method Terroir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TerroirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Terroir::class);
    }

    // /**
    //  * @return Terroir[] Returns an array of Terroir objects
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
    public function findOneBySomeField($value): ?Terroir
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
