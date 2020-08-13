<?php

namespace App\Repository;

use App\Entity\EquipementAgricole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EquipementAgricole|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipementAgricole|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipementAgricole[]    findAll()
 * @method EquipementAgricole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipementAgricoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipementAgricole::class);
    }

    // /**
    //  * @return EquipementAgricole[] Returns an array of EquipementAgricole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EquipementAgricole
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
