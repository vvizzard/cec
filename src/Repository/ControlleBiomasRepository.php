<?php

namespace App\Repository;

use App\Entity\ControlleBiomas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ControlleBiomas|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControlleBiomas|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControlleBiomas[]    findAll()
 * @method ControlleBiomas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControlleBiomasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControlleBiomas::class);
    }

    // /**
    //  * @return ControlleBiomas[] Returns an array of ControlleBiomas objects
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
    public function findOneBySomeField($value): ?ControlleBiomas
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
