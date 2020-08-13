<?php

namespace App\Controller;

use App\Entity\CultureMere;
use App\Entity\NbrFumureCultureM;
use App\Entity\NbrInsecticideCultureM;
use App\Repository\ControlleBiomasRepository;
use App\Repository\CultureMereRepository;
use App\Repository\CycleAgricoleRepository;
use App\Repository\DegatCycloniqueRepository;
use App\Repository\EtatMulchRepository;
use App\Repository\EtatPcRepository;
use App\Repository\FumureOrganiqueRepository;
use App\Repository\InsecticideRepository;
use App\Repository\ItineraireCulturalRepository;
use App\Repository\ModeInstallationRepository;
use App\Repository\ModeRepiquageRepository;
use App\Repository\ParcelleRepository;
use App\Repository\PrecedentCulturalRepository;
use App\Repository\PreparationParcelleRepository;
use App\Repository\SondageQualitatifRepository;
use App\Repository\SystemeCulturalRepository;
use App\Repository\TypePepiniereRepository;
use App\Repository\TypeSarclageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class CultureMereController extends AbstractController
{

    /**
     * @Route("/culture_meres", name="culture_meres")
     */
    public function index(CultureMereRepository $cultureMereRepository,
            FumureOrganiqueRepository $fumureOrganiqueRepository, 
            InsecticideRepository $insecticideRepository)
    {
        $cultureMeres = $cultureMereRepository->findAll();
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();

        return $this->render('culture_mere/index.html.twig', [
            'cultures' => $cultureMeres,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
        ]);
    }

    /**
     * @Route("/culture_mere/add", name="culture_mere_add")
     */
    public function add(HttpFoundationRequest $request, ObjectManager $objectManager, 
            CycleAgricoleRepository $cycleAgricoleRepository,
            PrecedentCulturalRepository $precedentCulturalRepository,
            SystemeCulturalRepository $systemeCulturalRepository, 
            ItineraireCulturalRepository $itineraireCulturalRepository,
            EtatPcRepository $etatPcRepository, EtatMulchRepository $etatMulchRepository,
            PreparationParcelleRepository $preparationParcelleRepository,
            ControlleBiomasRepository $controlleBiomasRepository, 
            ModeInstallationRepository $modeInstallationRepository, 
            TypePepiniereRepository $typePepiniereRepository, 
            ModeRepiquageRepository $modeRepiquageRepository,
            TypeSarclageRepository $typeSarclageRepository, ParcelleRepository $parcelleRepository,
            DegatCycloniqueRepository $degatCycloniqueRepository,
            SondageQualitatifRepository $sondageQualitatifRepository,
            FumureOrganiqueRepository $fumureOrganiqueRepository, 
            InsecticideRepository $insecticideRepository)
    {
        $cultureMere = new CultureMere();

        $cycleAgricoles = $cycleAgricoleRepository->findAll();
        $precedentCulturals = $precedentCulturalRepository->findAll();
        $systemeCulturals = $systemeCulturalRepository->findAll();
        $itineraireCulturals = $itineraireCulturalRepository->findAll();
        $etatPcs = $etatPcRepository->findAll();
        $etatMulchs = $etatMulchRepository->findAll();
        $preparationParcelles = $preparationParcelleRepository->findAll();
        $controlleBiomass = $controlleBiomasRepository->findAll();
        $modeInstallations = $modeInstallationRepository->findAll();
        $typePepinieres = $typePepiniereRepository->findAll();
        $modeRepiquages = $modeRepiquageRepository->findAll();
        $typeSarclages = $typeSarclageRepository->findAll();
        $degatCycloniques = $degatCycloniqueRepository->findAll();
        $sondageQualitatifs = $sondageQualitatifRepository->findAll();
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();
        $parcelles = $parcelleRepository->findAll();

        $form = $this->createFormBuilder($cultureMere)
                     ->add('nouvellePlantation')
                     ->add('surfaceCultive')
                     ->add('moPreparationSol')
                     ->add('moInstallationCulture')
                     ->add('moEntretien1')
                     ->add('moEntretien2')
                     ->add('moEntretien3')
                     ->add('moRecolte')
                     ->add('moExtPreparationSol')
                     ->add('moExtInstallationCulture')
                     ->add('moExtEntretien1')
                     ->add('moExtEntretien2')
                     ->add('moExtEntretien3')
                     ->add('moExtRecolte')
                     ->add('datePlantation')
                     ->add('agePlantation')
                     ->add('qteFumureOrganique')
                     ->add('qteInsecticide')
                     ->add('misEnCloture')
                     ->add('nbrSarclage')
                     ->add('utilisationPcFourage')
                     ->add('misEnCulture')
                     ->add('UtilisationPcPaillageSurAutreParcelle')
                     ->add('utilisationPcCompost')
                     ->add('basketCompost')
                     ->add('rente')
                     ->add('ecobuage')
                     ->add('sondageRendement')
                     ->add('pmg')
                     ->add('remarqueAVSF')
                     ->add('anneeAgricoleAVSF')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if($request->request->get('parcelle')) {
                $cultureMere->setParcelle($parcelleRepository->find(
                        $request->request->get('parcelle')));
            }
            if($request->request->get('cycleAgricole')) {
                $cultureMere->setCycleAgricole($cycleAgricoleRepository->find(
                        $request->request->get('cycleAgricole')));
            }
            if($request->request->get('precedentCultural')) {
                $cultureMere->setPrecedentCultural($precedentCulturalRepository->find(
                        $request->request->get('precedentCultural')));
            }
            if($request->request->get('systemeCultural')) {
                $cultureMere->setSystemeCultural($systemeCulturalRepository->find(
                        $request->request->get('systemeCultural')));
            }
            if($request->request->get('itineraireCultural')) {
                $cultureMere->setItineraireCultural($itineraireCulturalRepository->find(
                        $request->request->get('itineraireCultural')));
            }
            if($request->request->get('etatPc')) {
                $cultureMere->setEtatPc($etatPcRepository->find(
                        $request->request->get('etatPc')));
            }
            if($request->request->get('etatMulch')) {
                $cultureMere->setEtatMulch($etatMulchRepository->find(
                        $request->request->get('etatMulch')));
            }
            if($request->request->get('preparationParcelle')) {
                $cultureMere->setPreparationParcelle($preparationParcelleRepository->find(
                        $request->request->get('preparationParcelle')));
            }
            if($request->request->get('controlleBiomas')) {
                $cultureMere->setControlleBiomas($controlleBiomasRepository->find(
                        $request->request->get('controlleBiomas')));
            }
            if($request->request->get('modeInstallation')) {
                $cultureMere->setModeInstallation($modeInstallationRepository->find(
                        $request->request->get('modeInstallation')));
            }
            if($request->request->get('typePepiniere')) {
                $cultureMere->setTypePepiniere($typePepiniereRepository->find(
                        $request->request->get('typePepiniere')));
            }
            if($request->request->get('modeRepiquage')) {
                $cultureMere->setModeRepiquage($modeRepiquageRepository->find(
                        $request->request->get('modeRepiquage')));
            }
            if($request->request->get('typeSarclage')) {
                $cultureMere->setTypeSarclage($typeSarclageRepository->find(
                        $request->request->get('typeSarclage')));
            }
            if($request->request->get('degatCyclonique')) {
                $cultureMere->setDegatCyclonique($degatCycloniqueRepository->find(
                        $request->request->get('degatCyclonique')));
            }
            if($request->request->get('sondageQualitatif')) {
                $cultureMere->setSondageQualitatif($sondageQualitatifRepository->find(
                        $request->request->get('sondageQualitatif')));
            }

            $objectManager->persist($cultureMere);

            foreach ($fumures as $fumure) {
                $eid = $fumure->getId();
                if($request->request->get('fumure_'.$eid)) {
                    $temp = new NbrFumureCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setFumure($fumure);
                    $temp->setNbr($request->request->get('fumure_'.$eid));
                    
                    $objectManager->persist($temp);
                }
            }

            foreach ($insecticides as $insecticide) {
                $eid = $insecticide->getId();
                if($request->request->get('insecticide_'.$eid)) {
                    $temp = new NbrInsecticideCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setInsecticide($insecticide);
                    $temp->setNbr($request->request->get('insecticide_'.$eid));
                    
                    $objectManager->persist($temp);
                }
            }

            $objectManager->flush();

            return $this->redirectToRoute('culture_meres');
        }

        return $this->render('culture_mere/ajoutCulture.html.twig', [
            'cycleAgricoles' => $cycleAgricoles,
            'precedentCulturals' => $precedentCulturals,
            'systemeCulturals' => $systemeCulturals,
            'itineraireCulturals' => $itineraireCulturals,
            'etatPcs' => $etatPcs,
            'etatMulchs' => $etatMulchs,
            'preparationParcelles' => $preparationParcelles,
            'controlleBiomass' => $controlleBiomass,
            'modeInstallations' => $modeInstallations,
            'typePepinieres' => $typePepinieres,
            'modeRepiquages' => $modeRepiquages,
            'typeSarclages' => $typeSarclages,
            'degatCycloniques' => $degatCycloniques,
            'sondageQualitatifs' => $sondageQualitatifs,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
            'parcelles' => $parcelles,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/culture_mere/{id}", name="detail_culture_mere")
     */
    public function detail(CultureMere $cultureMere,
            FumureOrganiqueRepository $fumureOrganiqueRepository, 
            InsecticideRepository $insecticideRepository)
    {
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();

        return $this->render('culture_mere/detail_culture_mere.html.twig', [
            'culture' => $cultureMere,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
        ]);
    }

    /**
     * @Route("/culture_mere/add/{parcelleId}", name="culture_mere_add_from_parcelle")
     */
    public function addFromParcelle(HttpFoundationRequest $request, ObjectManager $objectManager, 
            CycleAgricoleRepository $cycleAgricoleRepository,
            PrecedentCulturalRepository $precedentCulturalRepository,
            SystemeCulturalRepository $systemeCulturalRepository, 
            ItineraireCulturalRepository $itineraireCulturalRepository,
            EtatPcRepository $etatPcRepository, EtatMulchRepository $etatMulchRepository,
            PreparationParcelleRepository $preparationParcelleRepository,
            ControlleBiomasRepository $controlleBiomasRepository, 
            ModeInstallationRepository $modeInstallationRepository, 
            TypePepiniereRepository $typePepiniereRepository, 
            ModeRepiquageRepository $modeRepiquageRepository,
            TypeSarclageRepository $typeSarclageRepository,
            DegatCycloniqueRepository $degatCycloniqueRepository,
            SondageQualitatifRepository $sondageQualitatifRepository,
            FumureOrganiqueRepository $fumureOrganiqueRepository, ParcelleRepository $parcelleRepository, 
            InsecticideRepository $insecticideRepository, $parcelleId)
    {
        $cultureMere = new CultureMere();

        $cycleAgricoles = $cycleAgricoleRepository->findAll();
        $precedentCulturals = $precedentCulturalRepository->findAll();
        $systemeCulturals = $systemeCulturalRepository->findAll();
        $itineraireCulturals = $itineraireCulturalRepository->findAll();
        $etatPcs = $etatPcRepository->findAll();
        $etatMulchs = $etatMulchRepository->findAll();
        $preparationParcelles = $preparationParcelleRepository->findAll();
        $controlleBiomass = $controlleBiomasRepository->findAll();
        $modeInstallations = $modeInstallationRepository->findAll();
        $typePepinieres = $typePepiniereRepository->findAll();
        $modeRepiquages = $modeRepiquageRepository->findAll();
        $typeSarclages = $typeSarclageRepository->findAll();
        $degatCycloniques = $degatCycloniqueRepository->findAll();
        $sondageQualitatifs = $sondageQualitatifRepository->findAll();
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();

        $form = $this->createFormBuilder($cultureMere)
                     ->add('nouvellePlantation')
                     ->add('surfaceCultive')
                     ->add('moPreparationSol')
                     ->add('moInstallationCulture')
                     ->add('moEntretien1')
                     ->add('moEntretien2')
                     ->add('moEntretien3')
                     ->add('moRecolte')
                     ->add('moExtPreparationSol')
                     ->add('moExtInstallationCulture')
                     ->add('moExtEntretien1')
                     ->add('moExtEntretien2')
                     ->add('moExtEntretien3')
                     ->add('moExtRecolte')
                     ->add('datePlantation')
                     ->add('agePlantation')
                     ->add('qteFumureOrganique')
                     ->add('qteInsecticide')
                     ->add('misEnCloture')
                     ->add('nbrSarclage')
                     ->add('utilisationPcFourage')
                     ->add('misEnCulture')
                     ->add('UtilisationPcPaillageSurAutreParcelle')
                     ->add('utilisationPcCompost')
                     ->add('basketCompost')
                     ->add('rente')
                     ->add('ecobuage')
                     ->add('sondageRendement')
                     ->add('pmg')
                     ->add('remarqueAVSF')
                     ->add('anneeAgricoleAVSF')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $cultureMere->setParcelle($parcelleRepository->find($parcelleId));

            if($request->request->get('cycleAgricole')) {
                $cultureMere->setCycleAgricole($cycleAgricoleRepository->find(
                        $request->request->get('cycleAgricole')));
            }
            if($request->request->get('precedentCultural')) {
                $cultureMere->setPrecedentCultural($precedentCulturalRepository->find(
                        $request->request->get('precedentCultural')));
            }
            if($request->request->get('systemeCultural')) {
                $cultureMere->setSystemeCultural($systemeCulturalRepository->find(
                        $request->request->get('systemeCultural')));
            }
            if($request->request->get('itineraireCultural')) {
                $cultureMere->setItineraireCultural($itineraireCulturalRepository->find(
                        $request->request->get('itineraireCultural')));
            }
            if($request->request->get('etatPc')) {
                $cultureMere->setEtatPc($etatPcRepository->find(
                        $request->request->get('etatPc')));
            }
            if($request->request->get('etatMulch')) {
                $cultureMere->setEtatMulch($etatMulchRepository->find(
                        $request->request->get('etatMulch')));
            }
            if($request->request->get('preparationParcelle')) {
                $cultureMere->setPreparationParcelle($preparationParcelleRepository->find(
                        $request->request->get('preparationParcelle')));
            }
            if($request->request->get('controlleBiomas')) {
                $cultureMere->setControlleBiomas($controlleBiomasRepository->find(
                        $request->request->get('controlleBiomas')));
            }
            if($request->request->get('modeInstallation')) {
                $cultureMere->setModeInstallation($modeInstallationRepository->find(
                        $request->request->get('modeInstallation')));
            }
            if($request->request->get('typePepiniere')) {
                $cultureMere->setTypePepiniere($typePepiniereRepository->find(
                        $request->request->get('typePepiniere')));
            }
            if($request->request->get('modeRepiquage')) {
                $cultureMere->setModeRepiquage($modeRepiquageRepository->find(
                        $request->request->get('modeRepiquage')));
            }
            if($request->request->get('typeSarclage')) {
                $cultureMere->setTypeSarclage($typeSarclageRepository->find(
                        $request->request->get('typeSarclage')));
            }
            if($request->request->get('degatCyclonique')) {
                $cultureMere->setDegatCyclonique($degatCycloniqueRepository->find(
                        $request->request->get('degatCyclonique')));
            }
            if($request->request->get('sondageQualitatif')) {
                $cultureMere->setSondageQualitatif($sondageQualitatifRepository->find(
                        $request->request->get('sondageQualitatif')));
            }

            $objectManager->persist($cultureMere);

            foreach ($fumures as $fumure) {
                $eid = $fumure->getId();
                if($request->request->get('fumure_'.$eid)) {
                    $temp = new NbrFumureCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setFumure($fumure);
                    $temp->setNbr($request->request->get('fumure_'.$eid));
                    
                    $objectManager->persist($temp);
                }
            }

            foreach ($insecticides as $insecticide) {
                $eid = $insecticide->getId();
                if($request->request->get('insecticide_'.$eid)) {
                    $temp = new NbrInsecticideCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setInsecticide($insecticide);
                    $temp->setNbr($request->request->get('insecticide_'.$eid));
                    
                    $objectManager->persist($temp);
                }
            }

            $objectManager->flush();

            return $this->redirectToRoute('detail_parcelle', ['id' => $parcelleId]);
        }

        return $this->render('culture_mere/ajoutCultureFromParcelle.html.twig', [
            'cycleAgricoles' => $cycleAgricoles,
            'precedentCulturals' => $precedentCulturals,
            'systemeCulturals' => $systemeCulturals,
            'itineraireCulturals' => $itineraireCulturals,
            'etatPcs' => $etatPcs,
            'etatMulchs' => $etatMulchs,
            'preparationParcelles' => $preparationParcelles,
            'controlleBiomass' => $controlleBiomass,
            'modeInstallations' => $modeInstallations,
            'typePepinieres' => $typePepinieres,
            'modeRepiquages' => $modeRepiquages,
            'typeSarclages' => $typeSarclages,
            'degatCycloniques' => $degatCycloniques,
            'sondageQualitatifs' => $sondageQualitatifs,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
            'base_form' => $form->createView(),
        ]);
    }
}
