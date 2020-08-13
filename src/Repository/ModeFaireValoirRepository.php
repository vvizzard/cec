<?php

namespace App\Repository;

use App\Entity\ModeFaireValoir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModeFaireValoir|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModeFaireValoir|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModeFaireValoir[]    findAll()
 * @method ModeFaireValoir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeFaireValoirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModeFaireValoir::class);
    }

    // /**
    //  * @return ModeFaireValoir[] Returns an array of ModeFaireValoir objects
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
    public function findOneBySomeField($value): ?ModeFaireValoir
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
