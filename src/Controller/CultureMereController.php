<?php

namespace App\Controller;

use App\Entity\CultureFille;
use App\Entity\CultureMere;
use App\Entity\NbrFumureCultureM;
use App\Entity\NbrInsecticideCultureM;
// use App\Repository\ControlleBiomasRepository;
use App\Repository\CultureMereRepository;
use App\Repository\CultureRepository;
use App\Repository\CycleAgricoleRepository;
// use App\Repository\DegatCycloniqueRepository;
// use App\Repository\EtatMulchRepository;
// use App\Repository\EtatPcRepository;
use App\Repository\FumureOrganiqueRepository;
use App\Repository\InsecticideRepository;
use App\Repository\ItineraireCulturalRepository;
// use App\Repository\ModeInstallationRepository;
// use App\Repository\ModeRepiquageRepository;
use App\Repository\ParcelleRepository;
use App\Repository\PrecedentCulturalRepository;
// use App\Repository\PreparationParcelleRepository;
// use App\Repository\SondageQualitatifRepository;
use App\Repository\SystemeCulturalRepository;
use App\Repository\VarieteRepository;
// use App\Repository\TypePepiniereRepository;
// use App\Repository\TypeSarclageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\ExcelService;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CultureMereController extends AbstractController
{

    /**
     * @Route("/culture_meres", name="culture_meres")
     */
    public function index(
        CultureMereRepository $cultureMereRepository,
        FumureOrganiqueRepository $fumureOrganiqueRepository,
        InsecticideRepository $insecticideRepository
    ) {
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
    public function add(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CycleAgricoleRepository $cycleAgricoleRepository,
        PrecedentCulturalRepository $precedentCulturalRepository,
        SystemeCulturalRepository $systemeCulturalRepository,
        ItineraireCulturalRepository $itineraireCulturalRepository,
        // EtatPcRepository $etatPcRepository,
        // EtatMulchRepository $etatMulchRepository,
        // PreparationParcelleRepository $preparationParcelleRepository,
        // ControlleBiomasRepository $controlleBiomasRepository,
        // ModeInstallationRepository $modeInstallationRepository,
        // TypePepiniereRepository $typePepiniereRepository,
        // ModeRepiquageRepository $modeRepiquageRepository,
        // TypeSarclageRepository $typeSarclageRepository,
        // DegatCycloniqueRepository $degatCycloniqueRepository,
        // SondageQualitatifRepository $sondageQualitatifRepository,
        ParcelleRepository $parcelleRepository,
        FumureOrganiqueRepository $fumureOrganiqueRepository,
        InsecticideRepository $insecticideRepository
    ) {
        $cultureMere = new CultureMere();

        $cycleAgricoles = $cycleAgricoleRepository->findAll();
        $precedentCulturals = $precedentCulturalRepository->findAll();
        $systemeCulturals = $systemeCulturalRepository->findAll();
        $itineraireCulturals = $itineraireCulturalRepository->findAll();
        // $etatPcs = $etatPcRepository->findAll();
        // $etatMulchs = $etatMulchRepository->findAll();
        // $preparationParcelles = $preparationParcelleRepository->findAll();
        // $controlleBiomass = $controlleBiomasRepository->findAll();
        // $modeInstallations = $modeInstallationRepository->findAll();
        // $typePepinieres = $typePepiniereRepository->findAll();
        // $modeRepiquages = $modeRepiquageRepository->findAll();
        // $typeSarclages = $typeSarclageRepository->findAll();
        // $degatCycloniques = $degatCycloniqueRepository->findAll();
        // $sondageQualitatifs = $sondageQualitatifRepository->findAll();
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();
        $parcelles = $parcelleRepository->findAll();

        $form = $this->createFormBuilder($cultureMere)
            ->add('nouvellePlantation', CheckboxType::class, [
                'label'    => 'Nouvelle plantation',
                'required' => false,
            ])
            //  cycle agricole
            ->add('surfaceCultive')
            //  precedent cultural + system + itineraire
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
            ->add('tarifMO')
            ->add('datePlantation')
            ->add('agePlantation')
            ->add('qteFumureOrganique')
            //  liste fumure
            ->add('qteInsecticide')
            //  liste insecticide
            // autre pesticide
            ->add('misEnCloture', CheckboxType::class, [
                'label'    => 'Mis en culture',
                'required' => false,
            ])
            //  ->add('nbrSarclage')
            //  ->add('utilisationPcFourage')
            //  ->add('misEnCulture')
            //  ->add('UtilisationPcPaillageSurAutreParcelle')
            //  ->add('utilisationPcCompost')
            //  ->add('basketCompost')
            //  ->add('rente')
            //  ->add('ecobuage')
            //  ->add('sondageRendement')
            //  ->add('pmg')
            //  ->add('remarqueAVSF')
            //  ->add('anneeAgricoleAVSF')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->get('parcelle')) {
                $cultureMere->setParcelle($parcelleRepository->find(
                    $request->request->get('parcelle')
                ));
            }
            if ($request->request->get('cycleAgricole')) {
                $cultureMere->setCycleAgricole($cycleAgricoleRepository->find(
                    $request->request->get('cycleAgricole')
                ));
            }
            if ($request->request->get('precedentCultural')) {
                $cultureMere->setPrecedentCultural($precedentCulturalRepository->find(
                    $request->request->get('precedentCultural')
                ));
            }
            if ($request->request->get('systemeCultural')) {
                $cultureMere->setSystemeCultural($systemeCulturalRepository->find(
                    $request->request->get('systemeCultural')
                ));
            }
            if ($request->request->get('itineraireCultural')) {
                $cultureMere->setItineraireCultural($itineraireCulturalRepository->find(
                    $request->request->get('itineraireCultural')
                ));
            }
            // if($request->request->get('etatPc')) {
            //     $cultureMere->setEtatPc($etatPcRepository->find(
            //             $request->request->get('etatPc')));
            // }
            // if($request->request->get('etatMulch')) {
            //     $cultureMere->setEtatMulch($etatMulchRepository->find(
            //             $request->request->get('etatMulch')));
            // }
            // if($request->request->get('preparationParcelle')) {
            //     $cultureMere->setPreparationParcelle($preparationParcelleRepository->find(
            //             $request->request->get('preparationParcelle')));
            // }
            // if($request->request->get('controlleBiomas')) {
            //     $cultureMere->setControlleBiomas($controlleBiomasRepository->find(
            //             $request->request->get('controlleBiomas')));
            // }
            // if($request->request->get('modeInstallation')) {
            //     $cultureMere->setModeInstallation($modeInstallationRepository->find(
            //             $request->request->get('modeInstallation')));
            // }
            // if($request->request->get('typePepiniere')) {
            //     $cultureMere->setTypePepiniere($typePepiniereRepository->find(
            //             $request->request->get('typePepiniere')));
            // }
            // if($request->request->get('modeRepiquage')) {
            //     $cultureMere->setModeRepiquage($modeRepiquageRepository->find(
            //             $request->request->get('modeRepiquage')));
            // }
            // if($request->request->get('typeSarclage')) {
            //     $cultureMere->setTypeSarclage($typeSarclageRepository->find(
            //             $request->request->get('typeSarclage')));
            // }
            // if($request->request->get('degatCyclonique')) {
            //     $cultureMere->setDegatCyclonique($degatCycloniqueRepository->find(
            //             $request->request->get('degatCyclonique')));
            // }
            // if($request->request->get('sondageQualitatif')) {
            //     $cultureMere->setSondageQualitatif($sondageQualitatifRepository->find(
            //             $request->request->get('sondageQualitatif')));
            // }

            $objectManager->persist($cultureMere);

            foreach ($fumures as $fumure) {
                $eid = $fumure->getId();
                if ($request->request->get('fumure_' . $eid)) {
                    $temp = new NbrFumureCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setFumure($fumure);
                    $temp->setNbr($request->request->get('fumure_' . $eid));

                    $objectManager->persist($temp);
                }
            }

            foreach ($insecticides as $insecticide) {
                $eid = $insecticide->getId();
                if ($request->request->get('insecticide_' . $eid)) {
                    $temp = new NbrInsecticideCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setInsecticide($insecticide);
                    $temp->setNbr($request->request->get('insecticide_' . $eid));

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
            // 'etatPcs' => $etatPcs,
            // 'etatMulchs' => $etatMulchs,
            // 'preparationParcelles' => $preparationParcelles,
            // 'controlleBiomass' => $controlleBiomass,
            // 'modeInstallations' => $modeInstallations,
            // 'typePepinieres' => $typePepinieres,
            // 'modeRepiquages' => $modeRepiquages,
            // 'typeSarclages' => $typeSarclages,
            // 'degatCycloniques' => $degatCycloniques,
            // 'sondageQualitatifs' => $sondageQualitatifs,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
            'parcelles' => $parcelles,
            'culture' => null,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/culture_mere/add/{parcelleId}", name="culture_mere_add_from_parcelle")
     */
    public function addFromParcelle(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CycleAgricoleRepository $cycleAgricoleRepository,
        PrecedentCulturalRepository $precedentCulturalRepository,
        SystemeCulturalRepository $systemeCulturalRepository,
        ItineraireCulturalRepository $itineraireCulturalRepository,
        // EtatPcRepository $etatPcRepository,
        // EtatMulchRepository $etatMulchRepository,
        // PreparationParcelleRepository $preparationParcelleRepository,
        // ControlleBiomasRepository $controlleBiomasRepository,
        // ModeInstallationRepository $modeInstallationRepository,
        // TypePepiniereRepository $typePepiniereRepository,
        // ModeRepiquageRepository $modeRepiquageRepository,
        // TypeSarclageRepository $typeSarclageRepository,
        // DegatCycloniqueRepository $degatCycloniqueRepository,
        // SondageQualitatifRepository $sondageQualitatifRepository,
        FumureOrganiqueRepository $fumureOrganiqueRepository,
        ParcelleRepository $parcelleRepository,
        InsecticideRepository $insecticideRepository,
        $parcelleId
    ) {
        $cultureMere = new CultureMere();

        $cycleAgricoles = $cycleAgricoleRepository->findAll();
        $precedentCulturals = $precedentCulturalRepository->findAll();
        $systemeCulturals = $systemeCulturalRepository->findAll();
        $itineraireCulturals = $itineraireCulturalRepository->findAll();
        // $etatPcs = $etatPcRepository->findAll();
        // $etatMulchs = $etatMulchRepository->findAll();
        // $preparationParcelles = $preparationParcelleRepository->findAll();
        // $controlleBiomass = $controlleBiomasRepository->findAll();
        // $modeInstallations = $modeInstallationRepository->findAll();
        // $typePepinieres = $typePepiniereRepository->findAll();
        // $modeRepiquages = $modeRepiquageRepository->findAll();
        // $typeSarclages = $typeSarclageRepository->findAll();
        // $degatCycloniques = $degatCycloniqueRepository->findAll();
        // $sondageQualitatifs = $sondageQualitatifRepository->findAll();
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();

        $form = $this->createFormBuilder($cultureMere)
            ->add('nouvellePlantation', CheckboxType::class, [
                'label'    => 'Nouvelle plantation',
                'required' => false,
            ])
            //  cycle agricole
            ->add('surfaceCultive')
            //  precedent cultural + system + itineraire
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
            ->add('tarifMO')
            ->add('datePlantation')
            ->add('agePlantation')
            ->add('qteFumureOrganique')
            //  liste fumure
            ->add('qteInsecticide')
            //  liste insecticide
            // autre pesticide
            ->add('misEnCloture', CheckboxType::class, [
                'label'    => 'Mis en culture',
                'required' => false,
            ])
            //  ->add('nbrSarclage')
            //  ->add('utilisationPcFourage')
            //  ->add('misEnCulture')
            //  ->add('UtilisationPcPaillageSurAutreParcelle')
            //  ->add('utilisationPcCompost')
            //  ->add('basketCompost')
            //  ->add('rente')
            //  ->add('ecobuage')
            //  ->add('sondageRendement')
            //  ->add('pmg')
            //  ->add('remarqueAVSF')
            //  ->add('anneeAgricoleAVSF')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cultureMere->setParcelle($parcelleRepository->find($parcelleId));

            if ($request->request->get('cycleAgricole')) {
                $cultureMere->setCycleAgricole($cycleAgricoleRepository->find(
                    $request->request->get('cycleAgricole')
                ));
            }
            if ($request->request->get('precedentCultural')) {
                $cultureMere->setPrecedentCultural($precedentCulturalRepository->find(
                    $request->request->get('precedentCultural')
                ));
            }
            if ($request->request->get('systemeCultural')) {
                $cultureMere->setSystemeCultural($systemeCulturalRepository->find(
                    $request->request->get('systemeCultural')
                ));
            }
            if ($request->request->get('itineraireCultural')) {
                $cultureMere->setItineraireCultural($itineraireCulturalRepository->find(
                    $request->request->get('itineraireCultural')
                ));
            }
            // if ($request->request->get('etatPc')) {
            //     $cultureMere->setEtatPc($etatPcRepository->find(
            //         $request->request->get('etatPc')
            //     ));
            // }
            // if ($request->request->get('etatMulch')) {
            //     $cultureMere->setEtatMulch($etatMulchRepository->find(
            //         $request->request->get('etatMulch')
            //     ));
            // }
            // if ($request->request->get('preparationParcelle')) {
            //     $cultureMere->setPreparationParcelle($preparationParcelleRepository->find(
            //         $request->request->get('preparationParcelle')
            //     ));
            // }
            // if ($request->request->get('controlleBiomas')) {
            //     $cultureMere->setControlleBiomas($controlleBiomasRepository->find(
            //         $request->request->get('controlleBiomas')
            //     ));
            // }
            // if ($request->request->get('modeInstallation')) {
            //     $cultureMere->setModeInstallation($modeInstallationRepository->find(
            //         $request->request->get('modeInstallation')
            //     ));
            // }
            // if ($request->request->get('typePepiniere')) {
            //     $cultureMere->setTypePepiniere($typePepiniereRepository->find(
            //         $request->request->get('typePepiniere')
            //     ));
            // }
            // if ($request->request->get('modeRepiquage')) {
            //     $cultureMere->setModeRepiquage($modeRepiquageRepository->find(
            //         $request->request->get('modeRepiquage')
            //     ));
            // }
            // if ($request->request->get('typeSarclage')) {
            //     $cultureMere->setTypeSarclage($typeSarclageRepository->find(
            //         $request->request->get('typeSarclage')
            //     ));
            // }
            // if ($request->request->get('degatCyclonique')) {
            //     $cultureMere->setDegatCyclonique($degatCycloniqueRepository->find(
            //         $request->request->get('degatCyclonique')
            //     ));
            // }
            // if ($request->request->get('sondageQualitatif')) {
            //     $cultureMere->setSondageQualitatif($sondageQualitatifRepository->find(
            //         $request->request->get('sondageQualitatif')
            //     ));
            // }

            $objectManager->persist($cultureMere);

            foreach ($fumures as $fumure) {
                $eid = $fumure->getId();
                if ($request->request->get('fumure_' . $eid)) {
                    $temp = new NbrFumureCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setFumure($fumure);
                    $temp->setNbr($request->request->get('fumure_' . $eid));

                    $objectManager->persist($temp);
                }
            }

            foreach ($insecticides as $insecticide) {
                $eid = $insecticide->getId();
                if ($request->request->get('insecticide_' . $eid)) {
                    $temp = new NbrInsecticideCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setInsecticide($insecticide);
                    $temp->setNbr($request->request->get('insecticide_' . $eid));

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
            // 'etatPcs' => $etatPcs,
            // 'etatMulchs' => $etatMulchs,
            // 'preparationParcelles' => $preparationParcelles,
            // 'controlleBiomass' => $controlleBiomass,
            // 'modeInstallations' => $modeInstallations,
            // 'typePepinieres' => $typePepinieres,
            // 'modeRepiquages' => $modeRepiquages,
            // 'typeSarclages' => $typeSarclages,
            // 'degatCycloniques' => $degatCycloniques,
            // 'sondageQualitatifs' => $sondageQualitatifs,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
            'parcelleId' => $parcelleId,
            'culture' => null,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/culture_mere/{id}", name="detail_culture_mere")
     */
    public function detail(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CultureMere $cultureMere,
        FumureOrganiqueRepository $fumureOrganiqueRepository,
        InsecticideRepository $insecticideRepository,
        VarieteRepository $varieteRepository,
        CultureRepository $cultureRepository
    ) {

        $cultureFille = new CultureFille();

        $form = $this->createFormBuilder($cultureFille)
            ->add('datePlantation', DateType::class, array(
                'widget' => 'choice',
                'format' => 'dd MM yyyy'
            ))
            ->add('QteSemence')
            ->add('prixUnitaireSemence')
            ->add('production')
            ->add('prixUnitaireProduit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cultureFille->setCultureMere($cultureMere);

            if ($request->request->get('variete')) {
                $cultureFille->setVariete($varieteRepository->find($request->request->get('variete')));
            }
            if ($request->request->get('plante')) {
                $cultureFille->setPlante($cultureRepository->find($request->request->get('plante')));
            }

            $objectManager->persist($cultureFille);
            $objectManager->flush();
        }

        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();

        $varietes = $varieteRepository->findAll();
        $plantes = $cultureRepository->findAll();

        return $this->render('culture_mere/detail_culture_mere.html.twig', [
            'culture' => $cultureMere,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
            'varietes' => $varietes,
            'plantes' => $plantes,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/culture_mere/update/{id}", name="update_culture_mere")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CycleAgricoleRepository $cycleAgricoleRepository,
        PrecedentCulturalRepository $precedentCulturalRepository,
        SystemeCulturalRepository $systemeCulturalRepository,
        ItineraireCulturalRepository $itineraireCulturalRepository,
        ParcelleRepository $parcelleRepository,
        FumureOrganiqueRepository $fumureOrganiqueRepository,
        InsecticideRepository $insecticideRepository,
        CultureMere $cultureMere
    ) {

        $cycleAgricoles = $cycleAgricoleRepository->findAll();
        $precedentCulturals = $precedentCulturalRepository->findAll();
        $systemeCulturals = $systemeCulturalRepository->findAll();
        $itineraireCulturals = $itineraireCulturalRepository->findAll();
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();
        $parcelles = $parcelleRepository->findAll();

        $form = $this->createFormBuilder($cultureMere)
            ->add('nouvellePlantation', CheckboxType::class, [
                'label'    => 'Nouvelle plantation',
                'required' => false,
            ])
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
            ->add('tarifMO')
            ->add('datePlantation')
            ->add('agePlantation')
            ->add('qteFumureOrganique')
            ->add('qteInsecticide')
            ->add('misEnCloture', CheckboxType::class, [
                'label'    => 'Mis en culture',
                'required' => false,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->get('parcelle')) {
                $cultureMere->setParcelle($parcelleRepository->find(
                    $request->request->get('parcelle')
                ));
            }
            if ($request->request->get('cycleAgricole')) {
                $cultureMere->setCycleAgricole($cycleAgricoleRepository->find(
                    $request->request->get('cycleAgricole')
                ));
            }
            if ($request->request->get('precedentCultural')) {
                $cultureMere->setPrecedentCultural($precedentCulturalRepository->find(
                    $request->request->get('precedentCultural')
                ));
            }
            if ($request->request->get('systemeCultural')) {
                $cultureMere->setSystemeCultural($systemeCulturalRepository->find(
                    $request->request->get('systemeCultural')
                ));
            }
            if ($request->request->get('itineraireCultural')) {
                $cultureMere->setItineraireCultural($itineraireCulturalRepository->find(
                    $request->request->get('itineraireCultural')
                ));
            }

            $objectManager->persist($cultureMere);

            foreach ($fumures as $fumure) {
                $eid = $fumure->getId();
                if ($request->request->get('fumure_' . $eid)) {
                    $temp = new NbrFumureCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setFumure($fumure);
                    $temp->setNbr($request->request->get('fumure_' . $eid));

                    $objectManager->persist($temp);
                }
            }

            foreach ($insecticides as $insecticide) {
                $eid = $insecticide->getId();
                if ($request->request->get('insecticide_' . $eid)) {
                    $temp = new NbrInsecticideCultureM();
                    $temp->setCulture($cultureMere);
                    $temp->setInsecticide($insecticide);
                    $temp->setNbr($request->request->get('insecticide_' . $eid));

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
            'fumures' => $fumures,
            'insecticides' => $insecticides,
            'parcelles' => $parcelles,
            'base_form' => $form->createView(),
            'culture' => $cultureMere,
        ]);
    }

    /**
     * @Route("/admin/culture_mere/delete/{id}", name="delete_culture_mere")
     */
    public function delete(CultureMere $cultureMere, ObjectManager $objectManager)
    {
        $objectManager->remove($cultureMere);
        $objectManager->flush();
        return $this->redirectToRoute('culture_meres');
    }

    /**
     * @Route("/export/culture", name="export_culture")
     */
    public function exportAction(CultureMereRepository $cultureMereRepository)
    {
        $filename = 'Cultures.xlsx';

        $excelService = new ExcelService();

        $spreadsheet = $excelService->writeCulture($cultureMereRepository);

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
     * @Route("/upload/culture", name="upload_culture")
     */
    public function upload(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CycleAgricoleRepository $cycleAgricoleRepository,
        PrecedentCulturalRepository $precedentCulturalRepository,
        SystemeCulturalRepository $systemeCulturalRepository,
        ItineraireCulturalRepository $itineraireCulturalRepository,
        ParcelleRepository $parcelleRepository,
        FumureOrganiqueRepository $fumureOrganiqueRepository,
        InsecticideRepository $insecticideRepository,
        CultureMereRepository $cultureMereRepository,
        CultureRepository $cultureRepository,
        VarieteRepository $varieteRepository
    ) {

        $file = $request->files->get('file');

        try {

            $fileName = 'Culture_uploaded' . (microtime(true) * 1000) . '.xlsx';

            $file->move($this->getParameter('upload_directory'), $fileName);

            $reader = new ReaderXlsx();
            $reader->setReadDataOnly(true);

            $spreadSheet = $reader->load($this->getParameter('upload_directory') . $fileName);

            $excelService = new ExcelService();

            $row = $excelService->upload($spreadSheet);

            foreach ($row as $r) {
                $culture = new CultureMere();
                try {
                    if (strpos($r[0], 'CL_') !== false) {
                        $r[0] = substr($r[0], 3);
                    }
                    if (intval($r[0]) > 0) {
                        $culture = $cultureMereRepository->find(intval($r[0]));
                    }
                    if (strpos($r[1], 'PL_') !== false) {
                        $r[1] = substr($r[0], 3);
                    }
                } catch (\Throwable $th) {
                    //$r[0] is not an int so we add a new instance
                }

                $r[21] = $excelService->formatDate($r[21]);

                // dump($r);

                $culture->complete($r);

                if ($r[1] != null) {
                    $culture->setParcelle($parcelleRepository->find(intVal($r[1])));
                }
                if ($r[3] != null) {
                    $culture->setCycleAgricole($cycleAgricoleRepository->findOneByNom($r[3]));
                }
                if ($r[5] != null) {
                    $culture->setPrecedentCultural($precedentCulturalRepository->findOneByNom($r[5]));
                }

                if ($r[6] != null) {
                    $culture->setSystemeCultural($systemeCulturalRepository->findOneByNom($r[6]));
                }

                if ($r[7] != null) {
                    $culture->setItineraireCultural($itineraireCulturalRepository->findOneByNom($r[7]));
                }

                $objectManager->persist($culture);

                if ($r[23] != null) {
                    $plante = $cultureRepository->findOneByNom($r[23]);

                    $principalFille = new CultureFille();

                    if (sizeof($culture->getCultureFilles()) > 0) {
                        $principalFille = $culture->getCultureFilles()[0];
                    } else {
                        $principalFille->setCultureMere($culture);
                    }

                    $principalFille->setPlante($plante);

                    if ($r[24] != null) {
                        $variete = $varieteRepository->findOneByNom($r[24]);
                        $principalFille->setVariete($variete);
                    }

                    $r[25] = $excelService->formatDate($r[25]);
                    $principalFille->setDatePlantationString($r[25]);
                    $principalFille->setQteSemence(intval($r[26]));
                    $principalFille->setPrixUnitaireSemence(intVal($r[27]));
                    $principalFille->setProduction(floatVal($r[28]));
                    $principalFille->setPrixUnitaireProduit(intval($r[29]));

                    $objectManager->persist($principalFille);
                }

                if ($r[30] != null) {
                    $plante = $cultureRepository->findOneByNom($r[30]);

                    $secondaireFille = new CultureFille();

                    if (sizeof($culture->getCultureFilles()) > 1) {
                        $secondaireFille = $culture->getCultureFilles()[1];
                    } else {
                        $secondaireFille->setCultureMere($culture);
                    }

                    $secondaireFille->setPlante($plante);

                    if ($r[31] != null) {
                        $variete = $varieteRepository->findOneByNom($r[31]);
                        $secondaireFille->setVariete($variete);
                    }

                    $r[32] = $excelService->formatDate($r[32]);
                    $secondaireFille->setDatePlantationString($r[32]);
                    $secondaireFille->setQteSemence(intval($r[33]));
                    $secondaireFille->setPrixUnitaireSemence(intval($r[34]));
                    $secondaireFille->setProduction(floatVal($r[35]));
                    $secondaireFille->setPrixUnitaireProduit(intval($r[36]));

                    $objectManager->persist($secondaireFille);
                }


                $fumures = $fumureOrganiqueRepository->findAll();

                foreach ($fumures as $fumure) {
                    if (strcasecmp($fumure->getNom(), 'NPK') == 0) {
                        $nbr = new NbrFumureCultureM();
                        if (sizeof($culture->getNbrFumureCultureMs()) > 0) {
                            foreach ($culture->getNbrFumureCultureMs() as $fumureCulture) {
                                if (strcasecmp($fumureCulture->getFumure()->getNom(), 'NPK') == 0) {
                                    $nbr = $fumureCulture;
                                    break;
                                }
                            }
                        }
                        $nbr->setFumure($fumure);
                        $nbr->setCulture($culture);
                        $r[38] != null ? $nbr->setNbr(intval($r[38])) : $nbr->setNbr(0);
                        $objectManager->persist($nbr);
                    } else if (strcasecmp($fumure->getNom(), 'Uree') == 0 || strcasecmp($fumure->getNom(), 'Urée') == 0) {
                        $nbr = new NbrFumureCultureM();
                        if (sizeof($culture->getNbrFumureCultureMs()) > 0) {
                            foreach ($culture->getNbrFumureCultureMs() as $fumureCulture) {
                                if (
                                    strcasecmp($fumureCulture->getFumure()->getNom(), 'Uree') == 0
                                    || strcasecmp($fumureCulture->getFumure()->getNom(), 'Urée') == 0
                                ) {
                                    $nbr = $fumureCulture;
                                    break;
                                }
                            }
                        }
                        $nbr->setFumure($fumure);
                        $nbr->setCulture($culture);
                        $r[39] != null ? $nbr->setNbr(intval($r[39])) : $nbr->setNbr(0);
                        $objectManager->persist($nbr);
                    } else if (
                        strcasecmp($fumure->getNom(), 'Autre') == 0 || strcasecmp($fumure->getNom(), 'Autre fumure') == 0
                        || strcasecmp($fumure->getNom(), 'Autres fumures') == 0
                    ) {
                        $nbr = new NbrFumureCultureM();
                        if (sizeof($culture->getNbrFumureCultureMs()) > 0) {
                            foreach ($culture->getNbrFumureCultureMs() as $fumureCulture) {
                                if (
                                    strcasecmp($fumureCulture->getFumure()->getNom(), 'Autre') == 0
                                    || strcasecmp($fumureCulture->getFumure()->getNom(), 'Autre fumure') == 0
                                    || strcasecmp($fumureCulture->getFumure()->getNom(), 'Autres fumures') == 0
                                ) {
                                    $nbr = $fumureCulture;
                                    break;
                                }
                            }
                        }
                        $nbr->setFumure($fumure);
                        $nbr->setCulture($culture);
                        $r[40] != null ? $nbr->setNbr(intval($r[40])) : $nbr->setNbr(0);
                        $objectManager->persist($nbr);
                    }
                }

                $insecticides = $insecticideRepository->findAll();

                foreach ($insecticides as $insecticide) {
                    if (strcasecmp($insecticide->getNom(), 'herbicide') == 0) {
                        $nbr = new NbrInsecticideCultureM();
                        if (sizeof($culture->getNbrInsecticideCultureMs()) > 0) {
                            foreach ($culture->getNbrInsecticideCultureMs() as $insecticideCulture) {
                                if (strcasecmp($insecticideCulture->getInsecticide()->getNom(), 'herbicide') == 0) {
                                    $nbr = $insecticideCulture;
                                    break;
                                }
                            }
                        }
                        $nbr->setInsecticide($insecticide);
                        $nbr->setCulture($culture);
                        $r[42] != null ? $nbr->setNbr(intval($r[42])) : $nbr->setNbr(0);
                        $objectManager->persist($nbr);
                    } else if (strcasecmp($insecticide->getNom(), 'fongicide') == 0) {
                        $nbr = new NbrInsecticideCultureM();
                        if (sizeof($culture->getNbrInsecticideCultureMs()) > 0) {
                            foreach ($culture->getNbrInsecticideCultureMs() as $insecticideCulture) {
                                if (strcasecmp($insecticideCulture->getInsecticide()->getNom(), 'Fongicide') == 0) {
                                    $nbr = $insecticideCulture;
                                    break;
                                }
                            }
                        }
                        $nbr->setInsecticide($insecticide);
                        $nbr->setCulture($culture);
                        $r[43] != null ? $nbr->setNbr(intval($r[43])) : $nbr->setNbr(0);
                        $objectManager->persist($nbr);
                    } else if (
                        strcasecmp($insecticide->getNom(), 'Autre') == 0 
                        || strcasecmp($insecticide->getNom(), 'Autre insecticide') == 0
                        || strcasecmp($insecticide->getNom(), 'Autres insecticides') == 0
                    ) {
                        $nbr = new NbrInsecticideCultureM();
                        if (sizeof($culture->getNbrInsecticideCultureMs()) > 0) {
                            foreach ($culture->getNbrInsecticideCultureMs() as $insecticideCulture) {
                                if (
                                    strcasecmp($insecticideCulture->getInsecticide()->getNom(), 'Autre') == 0
                                    || strcasecmp($insecticideCulture->getInsecticide()->getNom(), 'Autre insecticide') == 0
                                    || strcasecmp($insecticideCulture->getInsecticide()->getNom(), 'Autres insecticides') == 0
                                ) {
                                    $nbr = $insecticideCulture;
                                    break;
                                }
                            }
                        }
                        $nbr->setInsecticide($insecticide);
                        $nbr->setCulture($culture);
                        $r[44] != null ? $nbr->setNbr(intval($r[44])) : $nbr->setNbr(0);
                        $objectManager->persist($nbr);
                    }
                }

                $objectManager->flush();
            }

        } catch (FileException $e) {
            return $this->redirectToRoute('upload_culture_form');
        }

        return $this->redirectToRoute('culture_meres');

        // return $this->render('culture_mere/upload.html.twig');

        // return $this->redirectToRoute('detail_parcelle', ['id' => $row[2][0]]);

    }

    /**
     * @Route("/upload/parcelle_form", name="upload_culture_form")
     */
    public function uploads()
    {
        return $this->render('culture_mere/upload.html.twig');
    }
}
