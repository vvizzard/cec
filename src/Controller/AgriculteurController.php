<?php

namespace App\Controller;

use App\Entity\Agriculteur;
use App\Entity\NbrCultureAgriculteur;
use App\Entity\NbrElevageAgriculteur;
use App\Entity\NbrEquipementAgricoleAgriculteur;
use App\Repository\AgriculteurRepository;
use App\Repository\AncienneteAgriculteurRepository;
use App\Repository\BvpiRepository;
use App\Repository\CeRepository;
use App\Repository\CommuneRepository;
use App\Repository\CultureRepository;
use App\Repository\ElevageRepository;
use App\Repository\EquipementAgricoleRepository;
use App\Repository\OpRepository;
use App\Repository\RegionRepository;
use App\Repository\SousRegionRepository;
use App\Repository\TerroirRepository;
use App\Repository\TypologieRepository;
use App\Repository\VillageRepository;
use App\Repository\ZoneTechnicienRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class AgriculteurController extends AbstractController
{
    /**
     * @Route("/agriculteurs", name="agriculteurs")
     */
    public function index(AgriculteurRepository $agriculteurRepository, 
            CultureRepository $cultureRepository, ElevageRepository $elevageRepository,
            EquipementAgricoleRepository $equipementAgricoleRepository)
    {
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
    public function add(HttpFoundationRequest $request, ObjectManager $objectManager, 
            BvpiRepository $bvpiRepository, CeRepository $ceRepository, 
            CultureRepository $cultureRepository, ElevageRepository $elevageRepository,
            OpRepository $opRepository, TypologieRepository $typologieRepository, 
            EquipementAgricoleRepository $equipementAgricoleRepository,
            ZoneTechnicienRepository $zoneTechnicienRepository, VillageRepository $villageRepository,
            TerroirRepository $terroirRepository, SousRegionRepository $sousRegionRepository,
            RegionRepository $regionRepository, CommuneRepository $communeRepository,
            AncienneteAgriculteurRepository $ancienneteAgriculteurRepository)
    {
        $agriculteur = new Agriculteur();

        $elevages = $elevageRepository->findAll();
        $cultures = $cultureRepository->findAll();
        $equipements = $equipementAgricoleRepository->findAll();
        $villages = $villageRepository->findAll();
        $terroirs = $terroirRepository->findAll();
        $sousRegions = $sousRegionRepository->findAll();
        $regions = $regionRepository->findAll();
        $communes = $communeRepository->findAll();
        $anciennetes = $ancienneteAgriculteurRepository->findAll();

        $form = $this->createFormBuilder($agriculteur)
                    ->add('nom')
                    ->add('prenom')
                    ->add('genre')
                    ->add('age')
                    ->add('statutFamille')
                    // ->add('anciennete')
                    ->add('lot')
                    // ->add('region')
                    // ->add('sousRegion')
                    ->add('district')
                    // ->add('terroir')
                    // ->add('commune')
                    // ->add('village')
                    ->add('surfaceTotaleExploitee')
                    ->add('surfaceTotaleRiziere')
                    ->add('surfaceParcelleLouee')
                    ->add('surfaceParcelleEnLocation')
                    ->add('nbrMenage')
                    ->add('nbrActif')
                    ->add('nbrMoisAutosuffisanceRiz')
                    ->add('accesRiziere')
                    ->add('equipementAgricole')
                    ->add('pratiqueActiviteAgricole')
                    ->add('pratiqueElevageRente')
                    ->add('pratiqueActiviteNonAgricole')
                    ->add('pratiquePeche')
                    ->add('autreProgramme')
                    ->add('nbrMoisSoudure')
                    ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            // Complete agriculteur with foreign key
            if($request->request->get('bvpi')) {
                $agriculteur->setBvpi($bvpiRepository->find($request->request->get('bvpi')));
            }
            if($request->request->get('ce')) {
                $agriculteur->setCe($ceRepository->find($request->request->get('ce')));
            }
            // if($request->request->get('culture')) {
            //     $agriculteur->setCulture($cultureRepository->find($request->request->get('culture')));
            // }
            // if($request->request->get('elevage')) {
            //     $agriculteur->setElevage($elevageRepository->find($request->request->get('elevage')));
            // }
            // if($request->request->get('op')) {
            //     $agriculteur->setOP($opRepository->find($request->request->get('op')));
            // }

            if($request->request->get('village')) {
                $agriculteur->setVillage($villageRepository->find($request->request->get('village')));
            }

            if($request->request->get('terroir')) {
                $agriculteur->setTerroir($terroirRepository->find($request->request->get('terroir')));
            }

            if($request->request->get('sousRegion')) {
                $agriculteur->setSousRegion($sousRegionRepository->find($request->request
                        ->get('sousRegion')));
            }

            if($request->request->get('region')) {
                $agriculteur->setRegion($regionRepository->find($request->request->get('region')));
            }

            if($request->request->get('commune')) {
                $agriculteur->setCommune($communeRepository->find($request->request
                        ->get('commune')));
            }

            if($request->request->get('anciennete')) {
                $agriculteur->setAnciennete($ancienneteAgriculteurRepository->find(
                            $request->request->get('anciennete')));
            }

            if($request->request->get('op')) {
                $agriculteur->setOP($opRepository->find($request->request->get('op')));
            }
            if($request->request->get('typologie')) {
                $agriculteur->setTypologie($typologieRepository->find($request->request
                        ->get('typologie')));
            }
            if($request->request->get('zone_technicien')) {
                $agriculteur->setZoneTechnicien($zoneTechnicienRepository->find($request
                        ->request->get('zone_technicien')));
            }
            
            $objectManager->persist($agriculteur);

            foreach ($elevages as $elevage) {
                $eid = $elevage->getId();
                if($request->request->get('elevage_'.$eid)) {
                    $temp = new NbrElevageAgriculteur();
                    $temp->setAgriculteur($agriculteur);
                    $temp->setElevage($elevage);
                    $temp->setNbr($request->request->get('elevage_'.$eid));
                    
                    $objectManager->persist($temp);
                }
            }

            foreach ($cultures as $culture) {
                $eid = $culture->getId();
                if($request->request->get('culture_'.$eid)) {
                    $temp = new NbrCultureAgriculteur();
                    $temp->setAgriculteur($agriculteur);
                    $temp->setCulture($culture);
                    $temp->setNbr($request->request->get('culture_'.$eid));
                    
                    $objectManager->persist($temp);
                }
            }

            foreach ($equipements as $equipement) {
                $eid = $equipement->getId();
                if($request->request->get('equipement_'.$eid)) {
                    $temp = new NbrEquipementAgricoleAgriculteur();
                    $temp->setAgriculteur($agriculteur);
                    $temp->setEquipementAgricole($equipement);
                    $temp->setNbr($request->request->get('equipement_'.$eid));
                    
                    $objectManager->persist($temp);
                }
            }

            $objectManager->flush();

            return $this->redirectToRoute('detail_agriculteur', ['id'=>$agriculteur->id]);
        }

        return $this->render('agriculteur/ajoutAgriculteur.html.twig', [
            'form_agriculteur' => $form->createView(),
            'bvpis' => $bvpiRepository->findAll(),
            'ces' => $ceRepository->findAll(),
            'cultures' => $cultures,
            'elevages' => $elevages,
            'equipements' => $equipements,
            'ops' => $opRepository->findAll(),
            'typologies' => $typologieRepository->findAll(),
            'zoneTechniciens' => $zoneTechnicienRepository->findAll(),
            'villages' => $villages,
            'terroirs' => $terroirs,
            'sousRegions' => $sousRegions,
            'regions' => $regions,
            'communes' => $communes,
            'anciennetes' => $anciennetes,
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
