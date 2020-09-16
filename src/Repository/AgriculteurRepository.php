<?php

namespace App\Repository;

use App\Entity\Agriculteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Agriculteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Agriculteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Agriculteur[]    findAll()
 * @method Agriculteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgriculteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agriculteur::class);
    }

    // /**
    //  * @return Agriculteur[] Returns an array of Agriculteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Agriculteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function nbrGenre()
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('genre', 'genre');
        $res->addScalarResult('nbr', 'nbr');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT genre, COUNT(*) as nbr FROM agriculteur GROUP BY genre',
            $res
        );

        $result = $query->getScalarResult();

        return $result;
    }

    public function getStat($column)
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('nbr', 'nbr');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT COUNT(*)  AS nbr
                FROM agriculteur a 
                    WHERE a.'.$column.' = 2
            UNION ALL
                SELECT COUNT(b.id)
                    FROM agriculteur b
                        WHERE b.'.$column.' = 3
            UNION ALL
                SELECT COUNT(*) 
                    FROM agriculteur c
                        WHERE c.'.$column.' = 4
            UNION ALL
                SELECT COUNT(*)
                    FROM agriculteur d
                        WHERE d.'.$column.' = 1',
            $res
        );

        $result = $query->getScalarResult();

        return $result;
    }

    public function getStatSante()
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('nbr', 'nbr');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT COUNT(*)  AS nbr
                FROM agriculteur a 
                    WHERE a.medecin_traditionnel = false AND a.medecin_conventionnel = false
            UNION ALL
                SELECT COUNT(*)
                    FROM agriculteur b
                        WHERE b.medecin_traditionnel = true AND b.medecin_conventionnel = false
            UNION ALL
                SELECT COUNT(*) 
                    FROM agriculteur c
                        WHERE c.medecin_traditionnel = false AND c.medecin_conventionnel = true
            UNION ALL
                SELECT COUNT(*)
                    FROM agriculteur d
                        WHERE d.medecin_traditionnel = true AND d.medecin_conventionnel = true',
            $res
        );

        $result = $query->getScalarResult();

        return $result;
    }

    public function getAccesEau()
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('nbr', 'nbr');

        $query = $this->getEntityManager()->createNativeQuery('SELECT COUNT(*) AS nbr FROM agriculteur
        WHERE agriculteur.acces_eau_potable is true', $res);

        $result = $query->getSingleScalarResult();

        return $result;
    }

    public function getPerformance($agriculteurId, $cycle)
    {

        $res = new ResultSetMapping();
        $res->addScalarResult('annee', 'annee');
        $res->addScalarResult('systeme', 'systeme');
        $res->addScalarResult('prixderevient', 'prixderevient');
        $res->addScalarResult('charges', 'charges');
        $res->addScalarResult('rendement', 'rendement');
        $res->addScalarResult('productivite', 'productivite');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT 
                YEAR(mere.date_plantation) annee,
                sys.nom systeme, 
                SUM(fille.prix_unitaire_produit * fille.production) prixderevient, 
                ( 
                    SUM(fille.prix_unitaire_semence * fille.qte_semence) +
                    SUM( 
                        (mere.mo_preparation_sol * mere.tarif_mo) + (mere.mo_installation_culture * mere.tarif_mo) 
                        + (mere.mo_entretien1 * mere.tarif_mo)  + (mere.mo_entretien2 * mere.tarif_mo)
                        + (mere.mo_entretien3 * mere.tarif_mo) + (mere.mo_recolte * mere.tarif_mo)
                        + (mere.mo_ext_preparation_sol * mere.tarif_mo) + (mere.mo_ext_installation_culture * mere.tarif_mo) 
                        + (mere.mo_ext_entretien1 * mere.tarif_mo)  + (mere.mo_ext_entretien2 * mere.tarif_mo)
                        + (mere.mo_ext_entretien3 * mere.tarif_mo) + (mere.mo_ext_recolte * mere.tarif_mo)
                    ) +
                    SUM( nfumure.nbr * fumure.prix ) +
                    SUM( ninsecticides.nbr * insecticide.prix )
                ) charges,
                ( SUM(fille.production) / SUM(parcelle.surface) ) rendement,
                (
                    SUM(fille.production) /
                    SUM(
                        mere.mo_preparation_sol + mere.mo_installation_culture + mere.mo_entretien1 + 
                        mere.mo_entretien2 + mere.mo_entretien3 + mere.mo_recolte + mere.mo_ext_preparation_sol + mere.mo_ext_installation_culture + mere.mo_ext_entretien1 +
                        mere.mo_ext_entretien2 + mere.mo_ext_entretien3 + mere.mo_ext_recolte
                    ) / 365
                ) productivite
            FROM culture_fille fille 
                JOIN culture_mere mere 
                    ON mere.id = fille.culture_mere_id
                JOIN systeme_cultural sys 
                    ON sys.id = mere.systeme_cultural_id
                JOIN nbr_fumure_culture_m nfumure 
                    ON nfumure.culture_id = mere.id
                JOIN fumure_organique fumure 
                    ON fumure.id = nfumure.fumure_id
                JOIN nbr_insecticide_culture_m ninsecticides
                    ON ninsecticides.culture_id = mere.id
                JOIN insecticide
                    ON insecticide.id = ninsecticides.insecticide_id
                JOIN parcelle 
                    ON parcelle.id = mere.parcelle_id
                JOIN agriculteur
                    ON agriculteur.id = parcelle.agriculteur_id
            WHERE 
                agriculteur.id = ? AND mere.cycle_agricole_id = ?
            GROUP BY sys.nom, annee',
            $res
        );

        $query->setParameter(1, $agriculteurId);
        $query->setParameter(2, $cycle);

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
            WHERE  `table_schema`=\'cecdatabase\' AND `table_name`=\'agriculteur_search\'', $res);

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
            FROM agriculteur_search
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

}
