<?php

namespace App\Controller;

use App\Entity\Agriculteur;
use App\Entity\NbrCultureAgriculteur;
use App\Entity\NbrEquipementAgricoleAgriculteur;
use App\Repository\AgriculteurRepository;
use App\Repository\CeRepository;
use App\Repository\CommuneRepository;
use App\Repository\CultureRepository;
use App\Repository\ElevageRepository;
use App\Repository\EquipementAgricoleRepository;
use App\Repository\SousRegionRepository;
use App\Repository\TerroirRepository;
use App\Repository\TypeElevageRepository;
use App\Repository\TypologieRepository;
use App\Repository\VillageRepository;
use App\Services\ExcelService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AgriculteurController extends AbstractController
{
    /**
     * @Route("/agriculteurs", name="agriculteurs")
     */
    public function index(
        AgriculteurRepository $agriculteurRepository,
        CultureRepository $cultureRepository,
        ElevageRepository $elevageRepository,
        EquipementAgricoleRepository $equipementAgricoleRepository
    ) {
        $agriculteurs = $agriculteurRepository->findAll();
        $elevages = $elevageRepository->findBy([], ['id' => 'ASC']);
        $cultures = $cultureRepository->findBy([], ['id' => 'ASC']);
        $equipements = $equipementAgricoleRepository->findBy([], ['id' => 'ASC']);
        return $this->render('agriculteur/index.html.twig', [
            'agriculteurs' => $agriculteurs,
            'elevages' => $elevages,
            'cultures' => $cultures,
            'equipements' => $equipements,
        ]);
    }

    /**
     * @Route("/agriculteur/add", name="add_agriculteur")
     */
    public function add(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CeRepository $ceRepository,
        CultureRepository $cultureRepository,
        TypologieRepository $typologieRepository,
        EquipementAgricoleRepository $equipementAgricoleRepository,
        VillageRepository $villageRepository,
        TerroirRepository $terroirRepository,
        SousRegionRepository $sousRegionRepository,
        CommuneRepository $communeRepository,
        TypeElevageRepository $typeElevageRepository
    ) {
        $agriculteur = new Agriculteur();

        $cultures = $cultureRepository->findByRente(true);
        $equipements = $equipementAgricoleRepository->findAll();
        $villages = $villageRepository->findAll();
        $terroirs = $terroirRepository->findAll();
        $sousRegions = $sousRegionRepository->findAll();
        $communes = $communeRepository->findAll();
        $typeElevages = $typeElevageRepository->findAll();
        $ces = $ceRepository->findAll();
        $typologies = $typologieRepository->findAll();

        $form = $this->createFormBuilder($agriculteur)
            ->add('nom')
            ->add('prenom')
            // typologie
            // ->add('genre')
            ->add('age')
            ->add('statutFamille')
            ->add('nbrMenage') // ->taille de menage
            ->add('nbrActif')
            // ->add('district')
            // ->add('commune')
            // ->add('Fokontany')
            // ->add('village')
            // champ ecole
            // culture de rente prioritaire
            ->add('pratiqueElevageRente', CheckboxType::class, [
                'label'    => 'Elevage rente',
                'required' => false,
            ]) // -> Elevage
            // Type d'elevage prioritaire (api, vol, bov)
            /*->add('accesAuRiziere', CheckboxType::class, [
                'label'    => 'Accès rizière',
                'required' => false,
            ]) // acces a des riziere */
            ->add('opBoolean', CheckboxType::class, [
                'label'    => 'OP',
                'required' => false,
            ])
            ->add('pratiqueActiviteNonAgricole', CheckboxType::class, [
                'label'    => 'Pratique d\'activité non agricole',
                'required' => false,
            ]) // Pratique d'activite non agricole
            ->add('pratiquePeche', CheckboxType::class, [
                'label'    => 'Pratique de pêche',
                'required' => false,
            ])
            ->add('autreProgramme', CheckboxType::class, [
                'label'    => 'Actif dans d\'autre projet et programme',
                'required' => false,
            ])

            ->add('surfaceTotaleExploitee')
            ->add('surfaceTotaleRiziere')
            ->add('surfaceParcelleLouee')
            ->add('surfaceParcelleEnLocation')
            //nbr pieds agriculture xD
            //nbr equipement agricole
            ->add('nbrMoisSoudure')

            ->add('accesEauPotable', CheckboxType::class, [
                'label'    => 'Accès à l\'eau potable',
                'required' => false,
            ])
            ->add('medecinTraditionnel', CheckboxType::class, [
                'label'    => 'Médecin traditionnel',
                'required' => false,
            ])
            ->add('medecinConventionnel', CheckboxType::class, [
                'label'    => 'Médecin conventionnel',
                'required' => false,
            ])

            ->add('latitude')
            ->add('longitude')

            ->add('cereale')
            ->add('legumeSec')
            ->add('legume')
            ->add('fruit')
            ->add('viande')
            ->add('lait')
            ->add('sucre')
            ->add('huile')

            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Add some attributes that was not in the form above
            if ($request->request->get('genre') == 0 || $request->request->get('genre') == 1) {
                $agriculteur->setGenre($request->request->get('genre'));
            }
            if (!is_null($request->request->get('calendrier'))) {
                $agriculteur->setCalendrier(intval($request->request->get('calendrier')));
            }
            if (!is_null($request->request->get('outilAmeliore'))) {
                $agriculteur->setOutilAmeliore(intval($request->request->get('outilAmeliore')));
            }
            if (!is_null($request->request->get('differenceBesoinsAlimentaire'))) {
                $agriculteur->setDifferenceBesoinsAlimentaire(boolval($request->request->get('differenceBesoinsAlimentaire')));
            }
            if (!is_null($request->request->get('connaissanceDifferenceBesoinsAlimentaire'))) {
                $agriculteur->setConnaissanceDifferenceBesoinsAlimentaire(boolval($request->request->get('connaissanceDifferenceBesoinsAlimentaire')));
            }
            if (!is_null($request->request->get('regimeAlimentaireVariee'))) {
                $agriculteur->setRegimeAlimentaireVariee(boolval($request->request->get('regimeAlimentaireVariee')));
            }
            if (!is_null($request->request->get('assuranceProduitNecessaireAlimentation'))) {
                $agriculteur->setAssuranceProduitNecessaireAlimentation(intval($request->request->get('assuranceProduitNecessaireAlimentation')));
            }
            if (!is_null($request->request->get('enregistrementMouvementArgent'))) {
                $agriculteur->setEnregistrementMouvementArgent(boolval($request->request->get('enregistrementMouvementArgent')));
            }
            if (!is_null($request->request->get('enregistrementMouvementArgentWhy'))) {
                $agriculteur->setEnregistrementMouvementArgentWhy(intval($request->request->get('enregistrementMouvementArgentWhy')));
            }
            if (!is_null($request->request->get('epargne'))) {
                $agriculteur->setEpargne(intval($request->request->get('epargne')));
            }
            if (!is_null($request->request->get('connaissanceDemandeCoursProduitAgricole'))) {
                $agriculteur->setConnaissanceDemandeCoursProduitAgricole(boolval($request->request->get('connaissanceDemandeCoursProduitAgricole')));
            }
            if (!is_null($request->request->get('connaissanceDemandeCoursProduitAgricoleWhy'))) {
                $agriculteur->setConnaissanceDemandeCoursProduitAgricoleWhy(intval($request->request->get('connaissanceDemandeCoursProduitAgricoleWhy')));
            }
            if (!is_null($request->request->get('ameliorerQualiteProduit'))) {
                $agriculteur->setAmeliorerQualiteProduit(boolval($request->request->get('ameliorerQualiteProduit')));
            }
            if (!is_null($request->request->get('ameliorerQualiteProduitWhy'))) {
                $agriculteur->setAmeliorerQualiteProduitWhy(intval($request->request->get('ameliorerQualiteProduitWhy')));
            }
            if (!is_null($request->request->get('groupement'))) {
                $agriculteur->setGroupement(boolval($request->request->get('groupement')));
            }
            if (!is_null($request->request->get('avantageRegroupement'))) {
                $agriculteur->setAvantageRegroupement(intval($request->request->get('avantageRegroupement')));
            }
            if (!is_null($request->request->get('toilette'))) {
                $agriculteur->setToilette(intval($request->request->get('toilette')));
            }
            if (!is_null($request->request->get('douche'))) {
                $agriculteur->setDouche(intval($request->request->get('douche')));
            }
            if (!is_null($request->request->get('assainissement'))) {
                $agriculteur->setAssainissement(intval($request->request->get('assainissement')));
            }
            if (!is_null($request->request->get('accesEducation'))) {
                $agriculteur->setAccesEducation(intval($request->request->get('accesEducation')));
            }
            if (!is_null($request->request->get('accesRiziere'))) {
                $agriculteur->setAccesRiziere(intval($request->request->get('accesRiziere')));
            }

            // Complete agriculteur with foreign key
            if ($request->request->get('ce')) {
                $agriculteur->setCe($ceRepository->find($request->request->get('ce')));
            }
            if ($request->request->get('typeElevage')) {
                $agriculteur->setTypeElevage($typeElevageRepository->find($request->request->get('typeElevage')));
            }
            if ($request->request->get('culture')) {
                $agriculteur->setCulture($cultureRepository->find($request->request->get('culture')));
            }

            if ($request->request->get('village')) {
                $agriculteur->setVillage($villageRepository->find($request->request->get('village')));
            }

            if ($request->request->get('terroir')) {
                $agriculteur->setTerroir($terroirRepository->find($request->request->get('terroir')));
            }

            if ($request->request->get('sousRegion')) {
                $agriculteur->setSousRegion($sousRegionRepository->find($request->request
                    ->get('sousRegion')));
            }

            if ($request->request->get('commune')) {
                $agriculteur->setCommune($communeRepository->find($request->request
                    ->get('commune')));
            }

            if ($request->request->get('typologie')) {
                $agriculteur->setTypologie($typologieRepository->find($request->request
                    ->get('typologie')));
            }

            $objectManager->persist($agriculteur);

            foreach ($cultures as $culture) {
                $eid = $culture->getId();
                if ($request->request->get('culture_' . $eid)) {
                    $temp = new NbrCultureAgriculteur();
                    $temp->setAgriculteur($agriculteur);
                    $temp->setCulture($culture);
                    $temp->setNbr($request->request->get('culture_' . $eid));

                    $objectManager->persist($temp);
                }
            }

            foreach ($equipements as $equipement) {
                $eid = $equipement->getId();
                if ($request->request->get('equipement_' . $eid)) {
                    $temp = new NbrEquipementAgricoleAgriculteur();
                    $temp->setAgriculteur($agriculteur);
                    $temp->setEquipementAgricole($equipement);
                    $temp->setNbr($request->request->get('equipement_' . $eid));

                    $objectManager->persist($temp);
                }
            }

            $objectManager->flush();

            return $this->redirectToRoute('detail_agriculteur', ['id' => $agriculteur->getId()]);
        }

        return $this->render('agriculteur/ajoutAgriculteur.html.twig', [
            'form_agriculteur' => $form->createView(),
            'ces' => $ces,
            'cultures' => $cultures,
            'equipements' => $equipements,
            'typologies' => $typologies,
            'villages' => $villages,
            'terroirs' => $terroirs,
            'sousRegions' => $sousRegions,
            'communes' => $communes,
            'typeElevages' => $typeElevages,
            'agriculteur' => $agriculteur,
        ]);
    }

    /**
     * @Route("/agriculteur/update/{id}", name="update_agriculteur")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CeRepository $ceRepository,
        CultureRepository $cultureRepository,
        TypologieRepository $typologieRepository,
        EquipementAgricoleRepository $equipementAgricoleRepository,
        VillageRepository $villageRepository,
        TerroirRepository $terroirRepository,
        SousRegionRepository $sousRegionRepository,
        CommuneRepository $communeRepository,
        TypeElevageRepository $typeElevageRepository,
        Agriculteur $agriculteur
    ) {

        $cultures = $cultureRepository->findByRente(true);
        $equipements = $equipementAgricoleRepository->findAll();
        $villages = $villageRepository->findAll();
        $terroirs = $terroirRepository->findAll();
        $sousRegions = $sousRegionRepository->findAll();
        $communes = $communeRepository->findAll();
        $typeElevages = $typeElevageRepository->findAll();
        $ces = $ceRepository->findAll();
        $typologies = $typologieRepository->findAll();

        $form = $this->createFormBuilder($agriculteur)
            ->add('nom')
            ->add('prenom')
            ->add('age')
            ->add('statutFamille')
            ->add('nbrMenage')
            ->add('nbrActif')
            ->add('pratiqueElevageRente', CheckboxType::class, [
                'label'    => 'Elevage rente',
                'required' => false,
            ])
            //->add('accesAuRiziere')
            ->add('opBoolean', CheckboxType::class, [
                'label'    => 'OP',
                'required' => false,
            ])
            ->add('pratiqueActiviteNonAgricole', CheckboxType::class, [
                'label'    => 'Pratique d\'activité non agricole',
                'required' => false,
            ])
            ->add('pratiquePeche', CheckboxType::class, [
                'label'    => 'Pratique de pêche',
                'required' => false,
            ])
            ->add('autreProgramme', CheckboxType::class, [
                'label'    => 'Actif dans d\'autre projet et programme',
                'required' => false,
            ])

            ->add('surfaceTotaleExploitee')
            ->add('surfaceTotaleRiziere')
            ->add('surfaceParcelleLouee')
            ->add('surfaceParcelleEnLocation')
            ->add('nbrMoisSoudure')

            ->add('accesEauPotable', CheckboxType::class, [
                'label'    => 'Accès à l\'eau potable',
                'required' => false,
            ])
            ->add('medecinTraditionnel', CheckboxType::class, [
                'label'    => 'Médecin traditionnel',
                'required' => false,
            ])
            ->add('medecinConventionnel', CheckboxType::class, [
                'label'    => 'Médecin conventionnel',
                'required' => false,
            ])

            ->add('latitude')
            ->add('longitude')

            ->add('cereale')
            ->add('legumeSec')
            ->add('legume')
            ->add('fruit')
            ->add('viande')
            ->add('lait')
            ->add('sucre')
            ->add('huile')

            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Add some attributes that was not in the form above
            if ($request->request->get('genre') == 0 || $request->request->get('genre') == 1) {
                $agriculteur->setGenre($request->request->get('genre'));
            }
            if (!is_null($request->request->get('calendrier'))) {
                $agriculteur->setCalendrier(intval($request->request->get('calendrier')));
            }
            if (!is_null($request->request->get('outilAmeliore'))) {
                $agriculteur->setOutilAmeliore(intval($request->request->get('outilAmeliore')));
            }
            if (!is_null($request->request->get('differenceBesoinsAlimentaire'))) {
                $agriculteur->setDifferenceBesoinsAlimentaire(boolval($request->request->get('differenceBesoinsAlimentaire')));
            }
            if (!is_null($request->request->get('connaissanceDifferenceBesoinsAlimentaire'))) {
                $agriculteur->setConnaissanceDifferenceBesoinsAlimentaire(boolval($request->request->get('connaissanceDifferenceBesoinsAlimentaire')));
            }
            if (!is_null($request->request->get('regimeAlimentaireVariee'))) {
                $agriculteur->setRegimeAlimentaireVariee(boolval($request->request->get('regimeAlimentaireVariee')));
            }
            if (!is_null($request->request->get('assuranceProduitNecessaireAlimentation'))) {
                $agriculteur->setAssuranceProduitNecessaireAlimentation(intval($request->request->get('assuranceProduitNecessaireAlimentation')));
            }
            if (!is_null($request->request->get('enregistrementMouvementArgent'))) {
                $agriculteur->setEnregistrementMouvementArgent(boolval($request->request->get('enregistrementMouvementArgent')));
            }
            if (!is_null($request->request->get('enregistrementMouvementArgentWhy'))) {
                $agriculteur->setEnregistrementMouvementArgentWhy(intval($request->request->get('enregistrementMouvementArgentWhy')));
            }
            if (!is_null($request->request->get('epargne'))) {
                $agriculteur->setEpargne(intval($request->request->get('epargne')));
            }
            if (!is_null($request->request->get('connaissanceDemandeCoursProduitAgricole'))) {
                $agriculteur->setConnaissanceDemandeCoursProduitAgricole(boolval($request->request->get('connaissanceDemandeCoursProduitAgricole')));
            }
            if (!is_null($request->request->get('connaissanceDemandeCoursProduitAgricoleWhy'))) {
                $agriculteur->setConnaissanceDemandeCoursProduitAgricoleWhy(intval($request->request->get('connaissanceDemandeCoursProduitAgricoleWhy')));
            }
            if (!is_null($request->request->get('ameliorerQualiteProduit'))) {
                $agriculteur->setAmeliorerQualiteProduit(boolval($request->request->get('ameliorerQualiteProduit')));
            }
            if (!is_null($request->request->get('ameliorerQualiteProduitWhy'))) {
                $agriculteur->setAmeliorerQualiteProduitWhy(intval($request->request->get('ameliorerQualiteProduitWhy')));
            }
            if (!is_null($request->request->get('groupement'))) {
                $agriculteur->setGroupement(boolval($request->request->get('groupement')));
            }
            if (!is_null($request->request->get('avantageRegroupement'))) {
                $agriculteur->setAvantageRegroupement(intval($request->request->get('avantageRegroupement')));
            }
            if (!is_null($request->request->get('toilette'))) {
                $agriculteur->setToilette(intval($request->request->get('toilette')));
            }
            if (!is_null($request->request->get('douche'))) {
                $agriculteur->setDouche(intval($request->request->get('douche')));
            }
            if (!is_null($request->request->get('assainissement'))) {
                $agriculteur->setAssainissement(intval($request->request->get('assainissement')));
            }
            if (!is_null($request->request->get('accesEducation'))) {
                $agriculteur->setAccesEducation(intval($request->request->get('accesEducation')));
            }
            if (!is_null($request->request->get('accesRiziere'))) {
                $agriculteur->setAccesRiziere(intval($request->request->get('accesRiziere')));
            }

            // Complete agriculteur with foreign key
            if ($request->request->get('ce')) {
                $agriculteur->setCe($ceRepository->find($request->request->get('ce')));
            }
            if ($request->request->get('typeElevage')) {
                $agriculteur->setTypeElevage($typeElevageRepository->find($request->request->get('typeElevage')));
            }
            if ($request->request->get('culture')) {
                $agriculteur->setCulture($cultureRepository->find($request->request->get('culture')));
            }

            if ($request->request->get('village')) {
                $agriculteur->setVillage($villageRepository->find($request->request->get('village')));
            }

            if ($request->request->get('terroir')) {
                $agriculteur->setTerroir($terroirRepository->find($request->request->get('terroir')));
            }

            if ($request->request->get('sousRegion')) {
                $agriculteur->setSousRegion($sousRegionRepository->find($request->request
                    ->get('sousRegion')));
            }

            if ($request->request->get('commune')) {
                $agriculteur->setCommune($communeRepository->find($request->request
                    ->get('commune')));
            }

            if ($request->request->get('typologie')) {
                $agriculteur->setTypologie($typologieRepository->find($request->request
                    ->get('typologie')));
            }

            $objectManager->persist($agriculteur);

            foreach ($cultures as $culture) {
                $eid = $culture->getId();
                if ($request->request->get('culture_' . $eid)) {
                    $temp = new NbrCultureAgriculteur();
                    $temp->setAgriculteur($agriculteur);
                    $temp->setCulture($culture);
                    $temp->setNbr($request->request->get('culture_' . $eid));

                    $objectManager->persist($temp);
                }
            }

            foreach ($equipements as $equipement) {
                $eid = $equipement->getId();
                if ($request->request->get('equipement_' . $eid)) {
                    $temp = new NbrEquipementAgricoleAgriculteur();
                    $temp->setAgriculteur($agriculteur);
                    $temp->setEquipementAgricole($equipement);
                    $temp->setNbr($request->request->get('equipement_' . $eid));

                    $objectManager->persist($temp);
                }
            }

            $objectManager->flush();

            return $this->redirectToRoute('detail_agriculteur', ['id' => $agriculteur->getId()]);
        }

        return $this->render('agriculteur/ajoutAgriculteur.html.twig', [
            'form_agriculteur' => $form->createView(),
            'ces' => $ces,
            'cultures' => $cultures,
            'equipements' => $equipements,
            'typologies' => $typologies,
            'villages' => $villages,
            'terroirs' => $terroirs,
            'sousRegions' => $sousRegions,
            'communes' => $communes,
            'typeElevages' => $typeElevages,
            'agriculteur' => $agriculteur,
        ]);
    }

    /**
     * @Route("/agriculteur/{id}", name="detail_agriculteur")
     */
    public function detail(Agriculteur $agriculteur)
    {
        return $this->render('agriculteur/detailAgriculteur.html.twig', [
            'agriculteur' => $agriculteur,
        ]);
    }

    /**
     * @Route("/admin/agriculteur/delete/{id}", name="delete_agriculteur")
     */
    public function delete(Agriculteur $agriculteur, ObjectManager $objectManager)
    {
        $objectManager->remove($agriculteur);
        $objectManager->flush();
        return $this->redirectToRoute('agriculteurs');
    }

    /**
     * @Route("/export/agriculteur", name="export_agriculteur")
     */
    public function exportAction(AgriculteurRepository $agriculteurRepository)
    {
        $filename = 'Agriculteurs.xlsx';

        $excelService = new ExcelService();

        $spreadsheet = $excelService->writeAgriculteur($agriculteurRepository);

        $contentType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        $writer = new Xlsx($spreadsheet);

        $response = new StreamedResponse();
        $response->headers->set('Content-Type', $contentType);
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->setPrivate();
        $response->headers->addCacheControlDirective('no-cache', true);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        $response->setCallback(function () use ($writer) {
            $writer->save('php://output');
        });

        return $response;
    }

    /**
     * @Route("/upload/agriculteur", name="upload_agriculteur")
     */
    public function upload(
        HttpFoundationRequest $request,
        AgriculteurRepository $agriculteurRepository,
        CeRepository $ceRepository,
        CultureRepository $cultureRepository,
        TypologieRepository $typologieRepository,
        EquipementAgricoleRepository $equipementAgricoleRepository,
        VillageRepository $villageRepository,
        TerroirRepository $terroirRepository,
        SousRegionRepository $sousRegionRepository,
        CommuneRepository $communeRepository,
        TypeElevageRepository $typeElevageRepository,
        ObjectManager $objectManager
    ) {

        $file = $request->files->get('file');

        try {
            
            $fileName = 'Agriculteur_uploaded'.(microtime(true) * 1000).'.xlsx';

            $file->move($this->getParameter('upload_directory'), $fileName);

            $reader = new ReaderXlsx();
            $reader->setReadDataOnly(true);

            $spreadSheet = $reader->load($this->getParameter('upload_directory') . $fileName);

            $excelService = new ExcelService();

            $row = $excelService->upload($spreadSheet);

            foreach ($row as $r) {
                $agriculteur = new Agriculteur();
                try {
                    if( strpos($r[0], 'AG_') !== false ) {
                        $r[0] = substr($r[0], 3);
                    }
                    if(intval($r[0]) > 0) {
                        $agriculteur = $agriculteurRepository->find(intval($r[0]));
                    }
                } catch (\Throwable $th) {
                    //$r[0] is not an int so we add a new instance
                }

                $agriculteur->complete($r);

                if ($r[12] != null) {
                    $agriculteur->setCe($ceRepository->findOneByNom($r[12]));
                }
                if ($r[15] != null) {
                    $agriculteur->setTypeElevage($typeElevageRepository->findOneByNom($r[15]));
                }
                if ($r[13] != null) {
                    $agriculteur->setCulture($cultureRepository->findOneByNom($r[13]));
                }

                if ($r[11] != null) {
                    $agriculteur->setVillage($villageRepository->findOneByNom($r[11]));
                }

                if ($r[10] != null) {
                    $agriculteur->setTerroir($terroirRepository->findOneByNom($r[10]));
                }

                if ($r[8] != null) {
                    $agriculteur->setSousRegion($sousRegionRepository->findOneByNom($r[8]));
                }

                if ($r[9]) {
                    $agriculteur->setCommune($communeRepository->findOneByNom($r[9]));
                }

                if ($r[2] != null) {
                    $agriculteur->setTypologie($typologieRepository->findOneByNom($r[2]));
                }

                $objectManager->persist($agriculteur);

                $cultures = $cultureRepository->findByRente(true);
                $equipements = $equipementAgricoleRepository->findAll();

                foreach ($cultures as $culture) {

                    if ($culture->getNom() == 'Café' || $culture->getNom() == 'Cafe') {
                        $temp = new NbrCultureAgriculteur();
                        if (sizeof($agriculteur->getNbrCultureAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrCultureAgriculteur() as $cult) {
                                if ($cult->getCulture()->getId() == $culture->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setCulture($culture);
                        $temp->setNbr(intval($r[25]));

                        $objectManager->persist($temp);

                    } else if ($culture->getNom() == 'Girofle') {
                        $temp = new NbrCultureAgriculteur();
                        if (sizeof($agriculteur->getNbrCultureAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrCultureAgriculteur() as $cult) {
                                if ($cult->getCulture()->getId() == $culture->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setCulture($culture);
                        $temp->setNbr(intval($r[26]));

                        $objectManager->persist($temp);

                    } elseif ($culture->getNom() == 'Vanille') {
                        $temp = new NbrCultureAgriculteur();
                        if (sizeof($agriculteur->getNbrCultureAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrCultureAgriculteur() as $cult) {
                                if ($cult->getCulture()->getId() == $culture->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setCulture($culture);
                        $temp->setNbr(intval($r[27]));

                        $objectManager->persist($temp);

                    } elseif ($culture->getNom() == 'Poivre') {
                        $temp = new NbrCultureAgriculteur();
                        if (sizeof($agriculteur->getNbrCultureAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrCultureAgriculteur() as $cult) {
                                if ($cult->getCulture()->getId() == $culture->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setCulture($culture);
                        $temp->setNbr(intval($r[28]));

                        $objectManager->persist($temp);

                    }

                }

                foreach ($equipements as $equipement) {

                    if ($equipement->getNom() == 'Pulvérisateur' || $equipement->getNom() == 'Pulverisateur') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[29]));

                        $objectManager->persist($temp);

                    } else if ($equipement->getNom() == 'Brouette') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[30]));

                        $objectManager->persist($temp);

                    } else if ($equipement->getNom() == 'Arrosoir') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[31]));

                        $objectManager->persist($temp);

                    } else if ($equipement->getNom() == 'Herse') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[32]));

                        $objectManager->persist($temp);

                    } else if ($equipement->getNom() == 'Bicyclette') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[33]));

                        $objectManager->persist($temp);

                    } else if ($equipement->getNom() == 'Angady' || $equipement->getNom() == 'Pelle') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[34]));

                        $objectManager->persist($temp);

                    } else if ($equipement->getNom() == 'Charrue') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[35]));

                        $objectManager->persist($temp);

                    } else if ($equipement->getNom() == 'Pioche') {
                        $temp = new NbrEquipementAgricoleAgriculteur();
                        if (sizeof($agriculteur->getNbrEquipementAgricoleAgriculteur()) > 0) {
                            foreach ($agriculteur->getNbrEquipementAgricoleAgriculteur() as $cult) {
                                if ($cult->getEquipementAgricole()->getId() == $equipement->getId()) {
                                    $temp = $cult;
                                    break;
                                }
                            }
                        }
                        $temp->setAgriculteur($agriculteur);
                        $temp->setEquipementAgricole($equipement);
                        $temp->setNbr(intval($r[36]));

                        $objectManager->persist($temp);

                    }

                }

                $objectManager->flush();
            }
        } catch (FileException $e) {
            return $this->redirectToRoute('upload_agriculteur_form');
        }

        return $this->redirectToRoute('agriculteurs');

        // return $this->render('agriculteur/upload.html.twig');

        // return $this->redirectToRoute('detail_agriculteur', ['id' => $row[2][0]]);

    }

    /**
     * @Route("/upload/agriculteur_form", name="upload_agriculteur_form")
     */
    public function uploads()
    {
        return $this->render('agriculteur/upload.html.twig');
    }

    /**
     * @Route("/map/agriculteurs", name="map_agriculteurs")
     */
    public function map(
        AgriculteurRepository $agriculteurRepository
    ) {
        $agriculteurs = $agriculteurRepository->getForMap();

        return $this->json($agriculteurs);
    }

    /**
     * @Route("/map/agriculteur/{id}", name="map_agriculteur")
     */
    public function mapAgriculteur(Agriculteur $agriculteur) {
        $parcelles = array();
        foreach ($agriculteur->getParcelles() as $p) {
            if ($p->getLatitude()!==null && $p->getLongitude()!==null) {
                $parcelles[] = [
                    "id" => $p->getId(),
                    "latitude" => $p->getLatitude(),
                    "longitude" => $p->getLongitude(),
                ];
            }
        }
        $val = [
            "agriculteur" => [
                "id" => $agriculteur->getId(), 
                "latitude" => $agriculteur->getLatitude(),
                "longitude" => $agriculteur->getLongitude()
            ],
            "parcelles" => $parcelles
        ];
        return $this->json($val);
    }

    /**
     * @Route("/map/search/agriculteur", name="search_agriculteur")
     */
    public function search (
        HttpFoundationRequest $request,
        AgriculteurRepository $agriculteurRepository
    ) {

        $criterya = array();

        $text = null;

        // get research parameter
        if ($request->query->get('text') && $request->query->get('text')!=='' && $request->query->get('text')!==' ') {
            $text = $request->query->get('text');
        }
        if ($request->query->get('elevage') == 'true') {
            $criterya["pratiqueElevageRente"] = true;
        }
        /*if ($request->query->get('riziere') == 'true') {
            $criterya["accesAuRiziere"] = true;
        }*/
        if ($request->query->get('op') == 'true') {
            $criterya["opBoolean"] = true;
        }
        if ($request->query->get('nagricole') == 'true') {
            $criterya["pratiqueActiviteNonAgricole"] = true;
        }
        if ($request->query->get('peche') == 'true') {
            $criterya["pratiquePeche"] = true;
        }
        if ($request->query->get('eau') == 'true') {
            $criterya["accesEauPotable"] = true;
        }
        if (intval($request->query->get('education')) > 0) {
            $criterya["accesEducation"] = $request->query->get('education');
        }

        $agriculteurs = [];
        
        $text == null ? $agriculteurs = $agriculteurRepository->findBy($criterya) : $agriculteurs = $agriculteurRepository->globalSearch($text);
        
        $res = array();

        foreach ($agriculteurs as $a) {
            if($a->getLongitude() == null || $a->getLatitude() == null) {
                continue;
            }

            try {
                if ($a->getPratiqueElevageRente() !== $criterya["pratiqueElevageRente"]) {
                    continue;
                }
            } catch (\Throwable $th) {}
                
            try {
                if ($a->getAccesAuRiziere() !== $criterya["accesAuRiziere"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            try {
                if ($a->getOpBoolean() !== $criterya["opBoolean"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            try {
                if ($a->getPratiqueActiviteNonAgricole() !== $criterya["pratiqueActiviteNonAgricole"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            try {
                if ($a->getPratiquePeche() !== $criterya["pratiquePeche"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            try {
                if ($a->getAccesEauPotable() !== $criterya["accesEauPotable"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            try {
                if ($a->getAccesEducation() !== $criterya["accesEducation"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            
            $res[] = [
                "id" => $a->getId(),
                "longitude" => $a->getLongitude(),
                "latitude" => $a->getLatitude(),
            ];
        }

        return $this->json( $res);
    }
}
