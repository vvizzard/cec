<?php

namespace App\Repository;

use App\Entity\Parcelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Parcelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parcelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parcelle[]    findAll()
 * @method Parcelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parcelle::class);
    }

    // /**
    //  * @return Parcelle[] Returns an array of Parcelle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Parcelle
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function zoneErodibles()
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('commune', 'commune');
        $res->addScalarResult('nbr_p', 'nbr_p');
        $res->addScalarResult('surface', 'surface');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT c.nom AS commune, COUNT(p.id) AS nbr_p, SUM(p.surface) AS surface 
            FROM parcelle AS p
            JOIN agriculteur AS a on a.id = p.agriculteur_id
            JOIN commune c on c.id = a.commune_id
            WHERE p.zone_erodible = 1
            GROUP BY c.nom ORDER BY c.nom ASC',
            $res
        );

        $result = $query->getScalarResult();

        return $result;
    }

    private function getConcatColumn() {
        // Set session group value to be able to get all column
        $this->getEntityManager()->getConnection()->executeUpdate('SET SESSION group_concat_max_len = 1500000;');

        $res = new ResultSetMapping();
        $res->addScalarResult('concatenation', 'concatenation');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT GROUP_CONCAT(`column_name`) as concatenation
            FROM   `information_schema`.`columns` 
            WHERE  `table_schema`=\'cecdatabase\' AND `table_name`=\'parcelle_search\'', $res);

        $result = $query->getSingleScalarResult();

        // $result = substr($result, 0, -1);

        return $result;
    }

    public function globalSearch($text)
    {
        $res = new ResultSetMapping();
        $res->addScalarResult('id', 'id');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT DISTINCT id 
            FROM parcelle_search
            WHERE CONCAT_WS('. $this->getConcatColumn() .') like ?',
            $res
        );

        $query->setParameter(1, '%'.$text.'%');

        $result = $query->getScalarResult();

        $agriculteurs = array();

        foreach ($result as $key) {
            $agriculteurs[] = $this->find($key['id']);
        }

        return $agriculteurs;
    }

    public function getForMap()
    {
        $res = new ResultSetMapping();
        $res->addScalarResult('id', 'id');
        $res->addScalarResult('agriculteur_id', 'agriculteur_id');
        $res->addScalarResult('latitude', 'latitude');
        $res->addScalarResult('longitude', 'longitude');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT id, agriculteur_id, latitude, longitude FROM parcelle WHERE latitude IS NOT NULL AND longitude IS NOT NULL ', $res
        );

        return $query->getScalarResult();
    }
}
