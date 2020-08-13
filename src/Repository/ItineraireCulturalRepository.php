<?php

namespace App\Repository;

use App\Entity\ItineraireCultural;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItineraireCultural|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItineraireCultural|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItineraireCultural[]    findAll()
 * @method ItineraireCultural[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItineraireCulturalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItineraireCultural::class);
    }

    // /**
    //  * @return ItineraireCultural[] Returns an array of ItineraireCultural objects
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
    public function findOneBySomeField($value): ?ItineraireCultural
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
