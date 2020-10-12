<?php

namespace App\Services;

use App\Entity\ZoneTechnicien;
use App\Repository\AgriculteurRepository;
use App\Repository\CultureMereRepository;
use App\Repository\CultureRepository;
use App\Repository\ParcelleRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @method ZoneTechnicien|null find($id, $lockMode = null, $lockVersion = null)
 */
class ExcelService
{
    public function write($columnNames, $columnValues) {

        $spreadsheet = new Spreadsheet();

        // Get active sheet - it is also possible to retrieve a specific sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Set cell name and merge cells
        // $sheet->setCellValue('A1', 'Browser characteristics')->mergeCells('A1:D1');

        // Set column names
        

        $columnLetter = 'A';
        foreach ($columnNames as $columnName) {
            // Allow to access AA column if needed and more
            $sheet->setCellValue($columnLetter.'1', $columnName);
            $columnLetter++;
        }

        $i = 2; // Beginning row for active sheet
        foreach ($columnValues as $columnValue) {
            $columnLetter = 'A';
            foreach ($columnValue as $value) {
                $sheet->setCellValue($columnLetter.$i, $value);
                $columnLetter++;
            }
            $i++;
        }

        return $spreadsheet;
    }

    public function writeAgriculteur(AgriculteurRepository $repository) {
        
        $columnNames = [
            'ID',
            'Nom Agri',
            'Type d\'agri (Adoptant/relais/pilote/pépinièriste/vaccinateur)',
            'Genre (H/F)',
            'Age',
            'Statut au niveau de la famille',
            'Taille de ménage',
            'Nombre d\'actif',
            'District',
            'Commune',
            'Fokontany',
            'Village',
            'Champ école',
            'Culture de rente prioritaire (café/vanille/poivre/girofle',
            'Elevage (VRAI/FAUX)',
            'Type d\'élevage prioritaire (api/vol/bov)',
            'Accès à des rizières (rep: 1,/2/3)',
            'OP (VRAI/FAUX)',
            'Pratique d\'activité non agricole (VRAI/FAUX) ',
            'Pratique de pêche (VRAI/FAUX)',
            'Actif dans d\'autres projets & programme (VRAI/FAUX)',
            'Surface totale de l\'exploitation',
            'Surface rizière',
            'Surface parcelle louée',
            'Surface parcelle en location',
            'Nombre de pieds de caféiers ',
            'Nombre de pieds de Girofliers',
            'Nombre de pieds de Vanilliers',
            'Nombre de pieds de poiviriers',
            'Pulvérisateur',
            'Brouette',
            'arrosoirs',
            'herse',
            'Bicyclette',
            'Angady',
            'Nombre de mois de soudur',
            'Calendrier agricole Comment vous planifiez vos activités de production ? (rép1/2/3)',
            'Comment mesurez-vous vos parcelles et les intrants nécessaires à votre exploitation ? (rép1/2/3)',
            'Selon vous, les besoins en alimentation sont-ils les mêmes pour chaque membre du ménage ? (Oui/non)',
            'Si non, connaissez-vous cette différence de besoin ? (VRAI/FAUX)',
            'Votre régime alimentaire est-il varié ? Oui/non',
            'Comment assurez-vous la disponibilité des produits nécessaires à l\’alimentation tout au long de l\’année ? (Rép1/2)',
            'Vous enregistrez vos entrées et sorties d\’argent ? (rép1/2)',
            'Si oui, pourquoi faire ? (rép1/2)',
            'Comment vous épargnez votre argent ? (rép 1/2)',
            'Vous connaissez la demande et le cours des produits agricoles sur le marché ? (VRAI/FAUX)',
            'Pourquoi faire ? (1/2/3)',
            'Selon vous, est-il important d\’améliorer la qualité de vos produits ? (VRAI/FAUX)',
            'Si oui, pourquoi ? (1/2)',
            'Vous faites partie d\’un groupement ou d\’une coopérative ?(VRAI/FAUX)',
            'Selon vous, quels sont les avantages du regroupement ? (1/2/3)',
            'Accèes eau potable',
            'Toilettes',
            'Douche',
            'Autre assainissement',
            'Accès à l\'éducation',
            'Médecine traditionnelle',
            'Médecine conventionnelle',
            'Latitude',
            'Longitude',
            'Nombre de jours de consommation de céréales et tubercules / semaine',
            'Nombre de jours de consommation de légumes secs / semaine',
            'Nombre de jours de consommation de légumes / semaine',
            'Nombre de jours de consommation de fruits / semaine',
            'Nombre de jours de consommation de viande et poisson / semaine',
            'Nombre de jours de consommation de lait / semaine',
            'Nombre de jours de consommation de sucre / semaine',
            'Nombre de jours de consommation d\'huile / semaine',
        ];

        $agriculteurs = $repository->findAll();

        $columnValues = array();

        foreach ($agriculteurs as $agriculteur) {
            $columnValues[] = [
                $agriculteur->getId(),
                $agriculteur->getNom().' '.$agriculteur->getPrenom(),
                $agriculteur->getTypologie()->getNom(),
                $agriculteur->getGenre(),
                $agriculteur->getAge(),
                $agriculteur->getStatutFamille(),
                $agriculteur->getNbrMenage(),
                $agriculteur->getNbrActif(),
                $agriculteur->getSousRegionString(),
                $agriculteur->getCommuneString(),
                $agriculteur->getTerroirString(),
                $agriculteur->getVillageString(),
                $agriculteur->getCeString(),
                $agriculteur->getCultureString(),
                $agriculteur->getPratiqueElevageRente(),
                $agriculteur->getTypeElevageString(),
                $agriculteur->getAccesRiziere(),
                $agriculteur->getOpBoolean(),
                $agriculteur->getPratiqueActiviteNonAgricole(),
                $agriculteur->getPratiquePeche(),
                $agriculteur->getAutreProgramme(),
                $agriculteur->getSurfaceTotaleExploitee(),
                $agriculteur->getSurfaceTotaleRiziere(),
                $agriculteur->getSurfaceParcelleLouee(),
                $agriculteur->getSurfaceParcelleEnLocation(),
                $agriculteur->getNbrCaffe(),
                $agriculteur->getNbrGirofle(),
                $agriculteur->getNbrVanille(),
                $agriculteur->getNbrPoivre(),
                $agriculteur->getNbrPulverisateur(),
                $agriculteur->getNbrBrouette(),
                $agriculteur->getNbrArrosoir(),
                $agriculteur->getNbrHerse(),
                $agriculteur->getNbrBicyclette(),
                $agriculteur->getNbrAngady(),
                $agriculteur->getNbrMoisSoudure(),
                $agriculteur->getCalendrier(),
                $agriculteur->getOutilAmeliore(),
                $agriculteur->getDifferenceBesoinsAlimentaire(),
                $agriculteur->getConnaissanceDifferenceBesoinsAlimentaire(),
                $agriculteur->getRegimeAlimentaireVariee(),
                $agriculteur->getAssuranceProduitNecessaireAlimentation(),
                $agriculteur->getEnregistrementMouvementArgent(),
                $agriculteur->getEnregistrementMouvementArgentWhy(),
                $agriculteur->getEpargne(),
                $agriculteur->getConnaissanceDemandeCoursProduitAgricole(),
                $agriculteur->getConnaissanceDemandeCoursProduitAgricoleWhy(),
                $agriculteur->getAmeliorerQualiteProduit(),
                $agriculteur->getAmeliorerQualiteProduitWhy(),
                $agriculteur->getGroupement(),
                $agriculteur->getAvantageRegroupement(),
                $agriculteur->getAccesEauPotable(),
                $agriculteur->getToilette(),
                $agriculteur->getDouche(),
                $agriculteur->getAssainissement(),
                $agriculteur->getAccesEducation(),
                $agriculteur->getMedecinTraditionnel(),
                $agriculteur->getMedecinConventionnel(),
                $agriculteur->getLatitude(),
                $agriculteur->getLongitude(),
                $agriculteur->getCereale(),
                $agriculteur->getLegumeSec(),
                $agriculteur->getLegume(),
                $agriculteur->getFruit(),
                $agriculteur->getViande(),
                $agriculteur->getLait(),
                $agriculteur->getSucre(),
                $agriculteur->getHuile(),
            ];
        }

        return $this->write($columnNames, $columnValues);

    }

    public function writeParcelle(ParcelleRepository $repository) {
        
        $columnNames = [
            'ID',
            'ID Agriculteur',
            'Surface',
            'Type (démos, test, CEP, adoption)',
            'Type de sol (bon, mauvais, moyen)',
            'Mode de faire valoir',
            'Localisation (nom)',
            'Milieu (bas de pente, sommet, flanc, bas fond',
            'Irrigation (VRAI/FAUX)',
            'Compaction (VRAI/FAUX)',
            'Contre saison possible (VRAI/FAUX)',
            'Zone érodible (VRAI/FAUX)',
            'Latitude',
            'Longitude',
            'Observation',
        ];

        $parcelles = $repository->findAll();

        $columnValues = array();

        foreach ($parcelles as $parcelle) {
            $columnValues[] = [
                $parcelle->getId(),
                $parcelle->getAgriculteurString(),
                $parcelle->getSurface(),
                $parcelle->getTypeSolString(),
                $parcelle->getTypeSolString(),
                $parcelle->getModeFaireValoirString(),
                $parcelle->getLocalisation()->getNom(),
                $parcelle->getMilieuString(),
                $parcelle->getIrrigation(),
                $parcelle->getCompaction(),
                $parcelle->getContreSaison(),
                $parcelle->getZoneErodible(),
                $parcelle->getLatitude(),
                $parcelle->getLongitude(),
                $parcelle->getObservation(),
            ];
        }

        return $this->write($columnNames, $columnValues);

    }

    public function writeCulture(CultureMereRepository $repository) {

        $columnNames = [
            'ID',
            'ID Parcelle',
            'Nouvelle plantation (VRAI/FAUX)',
            'Cycle agricole',
            'Surface cultivée',
            'Précédent cultural',
            'Système cultural',
            'Itinéraire cultural',
            'MO préparation du sol',
            'MO Installation du culture',
            'MO entretien 1',
            'MO entretien 2',
            'MO entretien 3',
            'MO Récolte',
            'MO exté préparation du sol',
            'MO exté Installation du culture',
            'MO exté  entretien 1',
            'MO exté  entretien 2',
            'MO exté  entretien 3',
            'MO Récolte',
            'Prix MO',
            'Date de plantation',
            'Age de plantation',
            'Culture 1',
            'variété 1',
            'Date de plantation/semis 1',
            'Qté de semence/plant 1',
            'Prix unitaire de semence/plant 1',
            'Date de récolte 1',
            'Production 1',
            'Prix unitaire des produits',
            'Culture 2',
            'variété 2',
            'Date de plantation/semis 2',
            'Qté de semence/plant 2',
            'Prix unitaire de semence/plant 2',
            'Date de récolte 2',
            'Production 2',
            'Prix unitaire des produits 2',
            'Qté fumure organique',
            'NPK',
            'Urée',
            'autre fumure',
            'qté insectide',
            'qté herbicide',
            'qté fongicide',
            'qté autres pesticides',
            'Mis en culture (VRAI/FAUX)',
        ];

        $cultures = $repository->findAll();

        $columnValues = array();

        foreach ($cultures as $culture) {
            $columnValues[] = [
                $culture->getId(),
                $culture->getParcelleString(),
                $culture->getNouvellePlantation(),
                $culture->getCycleAgricoleString(),
                $culture->getSurfaceCultive(),
                $culture->getPrecedentCulturalString(),
                $culture->getSystemeCulturalString(),
                $culture->getItineraireCulturalString(),
                $culture->getMoPreparationSol(),
                $culture->getMoInstallationCulture(),
                $culture->getMoEntretien1(),
                $culture->getMoEntretien2(),
                $culture->getMoEntretien3(),
                $culture->getMoRecolte(),
                $culture->getMoExtPreparationSol(),
                $culture->getMoExtInstallationCulture(),
                $culture->getMoExtEntretien1(),
                $culture->getMoExtEntretien2(),
                $culture->getMoExtEntretien3(),
                $culture->getMoExtRecolte(),
                $culture->getTarifMO(),
                $culture->getDatePlantation(),
                $culture->getAgePlantation(),
            ];
                $fille = sizeof($culture->getCultureFilles());
                $index = sizeof($columnValues)-1;

                if ($fille > 0) {
                    $cft = $culture->getCultureFilles();
                    $cf = $cft[0];
                    $columnValues[$index][] = $cf->getPlanteString();
                    $columnValues[$index][] = $cf->getVarieteString();
                    $columnValues[$index][] = $cf->getDatePlantation();
                    $columnValues[$index][] = $cf->getQteSemence();
                    $columnValues[$index][] = $cf->getPrixUnitaireSemence();
                    $columnValues[$index][] = $cf->getDateRecolte();
                    $columnValues[$index][] = $cf->getProduction();
                    $columnValues[$index][] = $cf->getPrixUnitaireProduit();
                }
                if ($fille > 1) {
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getPlanteString();
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getVarieteString();
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getDatePlantation();
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getQteSemence();
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getPrixUnitaireSemence();
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getDateRecolte();
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getProduction();
                    $columnValues[$index][] = $culture->getCultureFilles()[1]->getPrixUnitaireProduit();
                } else {
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                }
                if($fille == 0) {
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                    $columnValues[$index][] = '';
                }

                $columnValues[sizeof($columnValues)-1][] = $culture->getQteFumureOrganique();

                $columnValues[sizeof($columnValues)-1][] = $culture->getNbrNPK();
                $columnValues[sizeof($columnValues)-1][] = $culture->getNbrUree();
                $columnValues[sizeof($columnValues)-1][] = $culture->getNbrAutreFumure();

                $columnValues[sizeof($columnValues)-1][] = $culture->getQteInsecticide();

                $columnValues[sizeof($columnValues)-1][] = $culture->getNbrHerbicide();
                $columnValues[sizeof($columnValues)-1][] = $culture->getNbrFongicide();
                $columnValues[sizeof($columnValues)-1][] = $culture->getNbrAutrePesticide();

                $columnValues[sizeof($columnValues)-1][] = $culture->getMisEnCloture();
        }

        return $this->write($columnNames, $columnValues);

    }

    public function upload($spreadsheet)
    {

        $worksheet = $spreadsheet->getActiveSheet();  // get active worksheet

        $rows = []; //empty array of rows
        $index = 0;

        foreach ($worksheet->getRowIterator() AS $row) {
            $cells = $row->getCellIterator();
            $cells->setIterateOnlyExistingCells(FALSE); // iterates through all cells, including empty ones
            $cellData = [];//
            foreach ($cells as $cell) {
                $cellData[] = $cell->getValue();
            }
            if ($index>0) {
                $rows[] = $cellData;    
            }
            $index++;
        }

        return $rows;
    }

    public function formatDate($date) {
        if (!$date|| $date == null) {
            return null;
        }
        if (!strpos($date, '-') !== false) {
            $time = (intval($date) - 25569) * 86400;
            return date('Y-m-d H:i:s', $time);
        }
        return $date;
    }

}
