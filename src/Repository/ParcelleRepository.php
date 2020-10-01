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
            WHERE CONCAT_WS(`id`, `agriculteur_id`, `type_id`, `type_sol_id`, `mode_faire_valoir_id`, `localisation_id`, `milieu_id`, `surface`, `irrigation`, `compaction`, `contre_saison`, `zone_erodible`, `longitude`, `latitude`, `observation`, `risque_innondation`, `ancien_code_parcelle`, `anciennete_id`, `zc_id`, `emplacement_pi_id`, `a_id`, `a_nom`, `a_prenom`, `a_genre`, `a_age`, `a_statut_famille`, `a_district`, `a_surface_totale_exploitee`, `a_surface_totale_riziere`, `a_surface_parcelle_louee`, `a_surface_parcelle_en_location`, `a_nbr_menage`, `a_nbr_actif`, `a_nbr_mois_autosuffisance_riz`, `a_acces_riziere`, `a_equipement_agricole`, `a_pratique_activite_agricole`, `a_pratique_elevage_rente`, `a_pratique_activite_non_agricole`, `a_pratique_peche`, `a_autre_programme`, `a_nbr_mois_soudure`, `a_typologie_id`, `a_bvpi_id`, `a_zone_technicien_id`, `a_op_id`, `a_ce_id`, `a_elevage_id`, `a_culture_id`, `a_village_id`, `a_terroir_id`, `a_sous_region_id`, `a_region_id`, `a_commune_id`, `a_anciennete_id`, `a_type_elevage_id`, `a_op_boolean`, `a_calendrier`, `a_outil_ameliore`, `a_difference_besoins_alimentaire`, `a_connaissance_difference_besoins_alimentaire`, `a_regime_alimentaire_variee`, `a_assurance_produit_necessaire_alimentation`, `a_enregistrement_mouvement_argent`, `a_enregistrement_mouvement_argent_why`, `a_epargne`, `a_connaissance_demande_cours_produit_agricole`, `a_connaissance_demande_cours_produit_agricole_why`, `a_ameliorer_qualite_produit`, `a_ameliorer_qualite_produit_why`, `a_groupement`, `a_avantage_regroupement`, `a_acces_eau_potable`, `a_toilette`, `a_douche`, `a_assainissement`, `a_acces_education`, `commune`, `village`, `region`, `sous_region`, `mode_faire_valoir`, `type`, `milieu`, `systeme_cultural`, `itineraire_cultural`, `precedent_cultural`, `fumure`, `insecticide`, `plante`) like ?',
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
