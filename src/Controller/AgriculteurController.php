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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

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
                'label'    => 'Elevage',
                'required' => false,
            ]) // -> Elevage
            // Type d'elevage prioritaire (api, vol, bov)
            ->add('accesRiziere', CheckboxType::class, [
                'label'    => 'Accès rizière',
                'required' => false,
            ]) // acces a des riziere
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
                $agriculteur->setConnaissanceDemandeCoursProduitAgricoleWhy(intval($request->request->get('connaissanceDemandeCoursProduitAgricoleWhy'))
                );
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
}
