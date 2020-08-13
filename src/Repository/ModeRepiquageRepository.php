<?php

namespace App\Repository;

use App\Entity\ModeRepiquage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModeRepiquage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeRepiquage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeRepiquage[]    findAll()
 * @method ModeRepiquage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeRepiquageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeRepiquage::class);
    }

    // /**
    //  * @return ModeRepiquage[] Returns an array of ModeRepiquage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModeRepiquage
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
