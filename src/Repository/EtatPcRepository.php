<?php

namespace App\Repository;

use App\Entity\EtatPc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatPc|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatPc|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatPc[]    findAll()
 * @method EtatPc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatPcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatPc::class);
    }

    // /**
    //  * @return EtatPc[] Returns an array of EtatPc objects
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
    public function findOneBySomeField($value): ?EtatPc
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
