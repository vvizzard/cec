<?php

namespace App\Repository;

use App\Entity\NbrEquipementAgricoleAgriculteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NbrEquipementAgricoleAgriculteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method NbrEquipementAgricoleAgriculteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method NbrEquipementAgricoleAgriculteur[]    findAll()
 * @method NbrEquipementAgricoleAgriculteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NbrEquipementAgricoleAgriculteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NbrEquipementAgricoleAgriculteur::class);
    }

    // /**
    //  * @return NbrEquipementAgricoleAgriculteur[] Returns an array of NbrEquipementAgricoleAgriculteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NbrEquipementAgricoleAgriculteur
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
