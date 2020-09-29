<?php

namespace App\Repository;

use App\Entity\SystemeCultural;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SystemeCultural|null find($id, $lockMode = null, $lockVersion = null)
 * @method SystemeCultural|null findOneBy(array $criteria, array $orderBy = null)
 * @method SystemeCultural[]    findAll()
 * @method SystemeCultural[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SystemeCulturalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SystemeCultural::class);
    }

    // /**
    //  * @return SystemeCultural[] Returns an array of SystemeCultural objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SystemeCultural
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function nbrSemence($nomSystemeCultural)
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('nbr', 'nbr');
        $res->addScalarResult('produit', 'produit');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT SUM(fille.qte_semence) AS nbr, SUM(fille.production) AS produit 
            FROM culture_fille AS fille
            JOIN culture_mere AS mere ON fille.culture_mere_id = mere.id
            JOIN systeme_cultural AS systeme ON systeme.id = mere.systeme_cultural_id
            WHERE systeme.nom = ?', $res
        );

        $query->setParameter(1, $nomSystemeCultural);

        $result = $query->getScalarResult();

        return $result;
    }
}
