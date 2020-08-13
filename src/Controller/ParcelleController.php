<?php

namespace App\Controller;

use App\Entity\ModeFaireValoir;
use App\Entity\Parcelle;
use App\Repository\AgriculteurRepository;
use App\Repository\AncienneteRepository;
use App\Repository\EmplacementPIRepository;
use App\Repository\FumureOrganiqueRepository;
use App\Repository\InsecticideRepository;
use App\Repository\LocalisationRepository;
use App\Repository\MilieuRepository;
use App\Repository\ModeFaireValoirRepository;
use App\Repository\ParcelleRepository;
use App\Repository\TypeRepository;
use App\Repository\TypeSolRepository;
use App\Repository\ZCRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ParcelleController extends AbstractController
{
    /**
     * @Route("/parcelles", name="parcelle")
     */
    public function index(ParcelleRepository $parcelleRepository)
    {
        $parcelles = $parcelleRepository->findAll();

        return $this->render('parcelle/index.html.twig', [
            'parcelles' => $parcelles,
        ]);
    }

    /**
     * @Route("/parcelle/add", name="add_parcelle")
     */
    public function add(Request $request, ObjectManager $objectManager,
            TypeRepository $typeRepository, TypeSolRepository $typeSolRepository,
            ModeFaireValoirRepository $modeFaireValoirRepository, 
            LocalisationRepository $localisationRepository, MilieuRepository $milieuRepository,
            AncienneteRepository $ancienneteRepository, ZCRepository $zCRepository,
            EmplacementPIRepository $emplacementPIRepository, 
            AgriculteurRepository $agriculteurRepository) {

        $parcelle = new Parcelle();

        $types = $typeRepository->findAll();
        $typeSols = $typeSolRepository->findAll();
        $modeFaireValoirs = $modeFaireValoirRepository->findAll();
        $localisations = $localisationRepository->findAll();
        $milieux = $milieuRepository->findAll();
        $anciennetes = $ancienneteRepository->findAll();
        $zCs = $zCRepository->findAll();
        $emplacements = $emplacementPIRepository->findAll();
        $agriculteurs = $agriculteurRepository->findAll();

        $form = $this->createFormBuilder($parcelle)
                     ->add('ancienCodeParcelle')
                     ->add('surface')
                     ->add('irrigation')
                     ->add('compaction')
                     ->add('contreSaison')
                     ->add('zoneErodible')
                     ->add('longitude')
                     ->add('latitude')
                     ->add('observation')
                     ->add('risqueInnondation')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // Complete parcelle with foreign key
            if($request->request->get('agriculteur')) {
                $parcelle->setAgriculteur($agriculteurRepository->find($request->request->get('agriculteur')));
            }
            if($request->request->get('type')) {
                $parcelle->setType($typeRepository->find($request->request->get('type')));
            }
            if($request->request->get('typeSol')) {
                $parcelle->setTypeSol($typeSolRepository->find($request->request->get('typeSol')));
            }
            if($request->request->get('modeFaireValoir')) {
                $parcelle->setModeFaireValoir($modeFaireValoirRepository->find(
                        $request->request->get('modeFaireValoir')));
            }
            if($request->request->get('localisation')) {
                $parcelle->setLocalisation($localisationRepository->find(
                        $request->request->get('localisation')));
            }
            if($request->request->get('milieu')) {
                $parcelle->setMilieu($milieuRepository->find($request->request->get('milieu')));
            }
            if($request->request->get('anciennete')) {
                $parcelle->setAnciennete($ancienneteRepository->find($request
                        ->request->get('anciennete')));
            }
            if($request->request->get('zc')) {
                $parcelle->setZc($zCRepository->find($request->request->get('zc')));
            }
            if($request->request->get('emplacement')) {
                $parcelle->setEmplacementPI($emplacementPIRepository->find(
                        $request->request->get('emplacement')));
            }
            
            $objectManager->persist($parcelle);

            $objectManager->flush();

            return $this->redirectToRoute('detail_parcelle', ['id' => $parcelle->id]);
        }

        return $this->render('parcelle/ajoutParcelle.html.twig', [
            'form_parcelle' => $form->createView(),
            'types' => $types,
            'typeSols' => $typeSols,
            'modeFaireValoirs' => $modeFaireValoirs,
            'localisations' => $localisations,
            'milieux' => $milieux,
            'anciennetes' => $anciennetes,
            'zCs' => $zCs,
            'emplacements' => $emplacements,
            'agriculteurs' => $agriculteurs,
        ]);
    }

    /**
     * @Route("/parcelle/{id}", name="detail_parcelle")
     */
    public function detail(Parcelle $parcelle, FumureOrganiqueRepository $fumureOrganiqueRepository, 
    InsecticideRepository $insecticideRepository)
    {
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();

        return $this->render('parcelle/detailParcelle.html.twig', [
            'parcelle' => $parcelle,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
        ]);
    }

    /**
     * @Route("/parcelle/add/{idAgriculteur}", name="add_parcelle_from_agriculteur")
     */
    public function addFromAgriculteur(Request $request, ObjectManager $objectManager,
            TypeRepository $typeRepository, TypeSolRepository $typeSolRepository,
            ModeFaireValoirRepository $modeFaireValoirRepository, 
            LocalisationRepository $localisationRepository, MilieuRepository $milieuRepository,
            AncienneteRepository $ancienneteRepository, ZCRepository $zCRepository,
            EmplacementPIRepository $emplacementPIRepository, 
            AgriculteurRepository $agriculteurRepository, $idAgriculteur) {

        $parcelle = new Parcelle();

        $types = $typeRepository->findAll();
        $typeSols = $typeSolRepository->findAll();
        $modeFaireValoirs = $modeFaireValoirRepository->findAll();
        $localisations = $localisationRepository->findAll();
        $milieux = $milieuRepository->findAll();
        $anciennetes = $ancienneteRepository->findAll();
        $zCs = $zCRepository->findAll();
        $emplacements = $emplacementPIRepository->findAll();

        $form = $this->createFormBuilder($parcelle)
                     ->add('ancienCodeParcelle')
                     ->add('surface')
                     ->add('irrigation')
                     ->add('compaction')
                     ->add('contreSaison')
                     ->add('zoneErodible')
                     ->add('longitude')
                     ->add('latitude')
                     ->add('observation')
                     ->add('risqueInnondation')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // Complete parcelle with foreign key
            $parcelle->setAgriculteur($agriculteurRepository->find($idAgriculteur));

            if($request->request->get('type')) {
                $parcelle->setType($typeRepository->find($request->request->get('type')));
            }
            if($request->request->get('typeSol')) {
                $parcelle->setTypeSol($typeSolRepository->find($request->request->get('typeSol')));
            }
            if($request->request->get('modeFaireValoir')) {
                $parcelle->setModeFaireValoir($modeFaireValoirRepository->find(
                        $request->request->get('modeFaireValoir')));
            }
            if($request->request->get('localisation')) {
                $parcelle->setLocalisation($localisationRepository->find(
                        $request->request->get('localisation')));
            }
            if($request->request->get('milieu')) {
                $parcelle->setMilieu($milieuRepository->find($request->request->get('milieu')));
            }
            if($request->request->get('anciennete')) {
                $parcelle->setAnciennete($ancienneteRepository->find($request
                        ->request->get('anciennete')));
            }
            if($request->request->get('zc')) {
                $parcelle->setZc($zCRepository->find($request->request->get('zc')));
            }
            if($request->request->get('emplacement')) {
                $parcelle->setEmplacementPI($emplacementPIRepository->find(
                        $request->request->get('emplacement')));
            }
            
            $objectManager->persist($parcelle);

            $objectManager->flush();

            return $this->redirectToRoute('detail_agriculteur', ['id' => $idAgriculteur]);
        }

        return $this->render('parcelle/ajoutParcelleFromAgriculteur.html.twig', [
            'form_parcelle' => $form->createView(),
            'types' => $types,
            'typeSols' => $typeSols,
            'modeFaireValoirs' => $modeFaireValoirs,
            'localisations' => $localisations,
            'milieux' => $milieux,
            'anciennetes' => $anciennetes,
            'zCs' => $zCs,
            'emplacements' => $emplacements,
        ]);
    }
}
