<?php

namespace App\Repository;

use App\Entity\ZoneTechnicien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZoneTechnicien|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZoneTechnicien|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZoneTechnicien[]    findAll()
 * @method ZoneTechnicien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneTechnicienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZoneTechnicien::class);
    }

    // /**
    //  * @return ZoneTechnicien[] Returns an array of ZoneTechnicien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZoneTechnicien
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
