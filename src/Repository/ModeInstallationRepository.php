<?php

namespace App\Repository;

use App\Entity\ModeInstallation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModeInstallation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeInstallation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeInstallation[]    findAll()
 * @method ModeInstallation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeInstallationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeInstallation::class);
    }

    // /**
    //  * @return ModeInstallation[] Returns an array of ModeInstallation objects
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
    public function findOneBySomeField($value): ?ModeInstallation
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
