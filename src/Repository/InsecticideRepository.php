<?php

namespace App\Repository;

use App\Entity\Insecticide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Insecticide|null find($id, $lockMode = null, $lockVersion = null)
 * @method Insecticide|null findOneBy(array $criteria, array $orderBy = null)
 * @method Insecticide[]    findAll()
 * @method Insecticide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InsecticideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Insecticide::class);
    }

    // /**
    //  * @return Insecticide[] Returns an array of Insecticide objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Insecticide
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
