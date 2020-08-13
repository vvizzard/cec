<?php

namespace App\Repository;

use App\Entity\Ce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ce[]    findAll()
 * @method Ce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ce::class);
    }

    // /**
    //  * @return Ce[] Returns an array of Ce objects
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
    public function findOneBySomeField($value): ?Ce
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
