<?php

namespace App\Repository;

use App\Entity\CultureMere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CultureMere|null find($id, $lockMode = null, $lockVersion = null)
 * @method CultureMere|null findOneBy(array $criteria, array $orderBy = null)
 * @method CultureMere[]    findAll()
 * @method CultureMere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CultureMereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CultureMere::class);
    }

    // /**
    //  * @return CultureMere[] Returns an array of CultureMere objects
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
    public function findOneBySomeField($value): ?CultureMere
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function compaigne()
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('compaigne', 'compaigne');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT DISTINCT YEAR(c.date_plantation) as compaigne FROM culture_mere AS c ORDER BY compaigne ASC',
            $res
        );

        $result = $query->getScalarResult();

        return $result;
    }

    public function rapportSurface($idCommune, $compaigne, $idCycleAgricole)
    {

        if ($idCommune == null || $compaigne == null || $idCycleAgricole == null) {
            return array();
        }

        $res = new ResultSetMapping();
        $res->addScalarResult('nom', 'nom');
        $res->addScalarResult('nbr_p', 'nbr_p');
        $res->addScalarResult('nbr_a', 'nbr_a');
        $res->addScalarResult('surface', 'surface');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT ic.nom, COUNT(p.id) as nbr_p, COUNT(a.id) as nbr_a, SUM(c.surface_cultive) as surface from culture_mere as c 
            JOIN parcelle as p on p.id = c.parcelle_id
            JOIN agriculteur as a on a.id = p.agriculteur_id
            JOIN itineraire_cultural as ic on c.itineraire_cultural_id = ic.id
            WHERE a.commune_id = ? AND YEAR(c.date_plantation) = ? AND c.cycle_agricole_id = ?
            GROUP BY c.itineraire_cultural_id',
            $res
        );

        $query->setParameter(1, $idCommune);
        $query->setParameter(2, $compaigne);
        $query->setParameter(3, $idCycleAgricole);

        $result = $query->getScalarResult();

        return $result;
    }

    public function rapportRendement($idCommune, $compaigne, $idCycleAgricole)
    {

        if ($idCommune == null || $compaigne == null || $idCycleAgricole == null) {
            return array();
        }

        $res = new ResultSetMapping();
        $res->addScalarResult('culture', 'culture');
        $res->addScalarResult('surface', 'surface');
        $res->addScalarResult('nbr_p', 'nbr_p');
        $res->addScalarResult('moy_rdt', 'moy_rdt');
        $res->addScalarResult('coef_var', 'coef_var');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT
                plante.nom AS culture,
                SUM(mere.surface_cultive) AS surface, 
                COUNT(mere.parcelle_id) AS nbr_p,
                ( AVG(fille.production / mere.surface_cultive)) AS moy_rdt,
                ( STD(fille.production / mere.surface_cultive) / AVG(fille.production / mere.surface_cultive) ) AS coef_var
            FROM culture_mere AS mere
                JOIN culture_fille AS fille ON fille.culture_mere_id = mere.id
                JOIN culture AS plante ON plante.id = fille.plante_id
                JOIN parcelle AS p ON p.id = mere.parcelle_id
                JOIN agriculteur AS a ON a.id = p.agriculteur_id
                JOIN commune ON commune.id = a.commune_id
                JOIN cycle_agricole AS cycle ON cycle.id = mere.cycle_agricole_id
            WHERE 
                a.commune_id = ? AND 
                YEAR(fille.date_plantation) = ? AND 
                mere.cycle_agricole_id = ?
            GROUP BY plante.nom',
            $res
        );

        $query->setParameter(1, $idCommune);
        $query->setParameter(2, $compaigne);
        $query->setParameter(3, $idCycleAgricole);

        $result = $query->getScalarResult();

        return $result;
    }

    public function getProductivite($idCommune = null, $compaigne = null)
    {
        $res = new ResultSetMapping();
        $res->addScalarResult('commune', 'commune');
        $res->addScalarResult('annee', 'annee');
        $res->addScalarResult('MO', 'mo');
        $res->addScalarResult('production', 'production');
        $res->addScalarResult('productivite', 'productivite');

        $query = 'SELECT temp.*, ((temp.production / temp.MO) / 365) AS productivite FROM(
            SELECT cm.nom AS commune, cm.id AS commune_id, YEAR(c.date_plantation) AS annee, (c.mo_preparation_sol + c.mo_installation_culture + c.mo_entretien1 + 
            c.mo_entretien2 + c.mo_entretien3 + c.mo_recolte + c.mo_ext_preparation_sol + c.mo_ext_installation_culture + c.mo_ext_entretien1 +
            c.mo_ext_entretien2 + c.mo_ext_entretien3 + c.mo_ext_recolte) AS MO, SUM(fille.production) AS production
            FROM culture_mere AS c
            JOIN parcelle AS p ON p.id = c.parcelle_id
            JOIN agriculteur AS a ON a.id = p.agriculteur_id
            JOIN commune AS cm ON cm.id = a.commune_id
            JOIN culture_fille AS fille
            GROUP BY commune, commune_id, annee, MO
        ) AS temp
        WHERE 1 = 1 ';

        if ($idCommune != null) {
            $query = $query . 'AND temp.commune_id = ? ';
        }
        if ($compaigne != null) {
            $query = $query . 'AND temp.annee = ? ';
        }

        $query = $query . ' ORDER BY temp.annee DESC';

        $query = $this->getEntityManager()->createNativeQuery(
            $query,
            $res
        );

        $indexParam = 1;

        if ($idCommune != null) {
            $query->setParameter($indexParam, $idCommune);
            $indexParam++;
        }
        if ($compaigne != null) {
            $query->setParameter($indexParam, $compaigne);
            $indexParam++;
        }

        $result = $query->getScalarResult();

        return $result;
    }
}
