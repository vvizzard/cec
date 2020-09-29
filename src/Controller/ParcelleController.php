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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\ExcelService;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ParcelleController extends AbstractController
{
    /**
     * @Route("/parcelles", name="parcelles")
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
    public function add(
        Request $request,
        ObjectManager $objectManager,
        TypeRepository $typeRepository,
        TypeSolRepository $typeSolRepository,
        ModeFaireValoirRepository $modeFaireValoirRepository,
        LocalisationRepository $localisationRepository,
        MilieuRepository $milieuRepository,
        AgriculteurRepository $agriculteurRepository
    ) {

        $parcelle = new Parcelle();

        $types = $typeRepository->findAll();
        $typeSols = $typeSolRepository->findAll();
        $modeFaireValoirs = $modeFaireValoirRepository->findAll();
        $localisations = $localisationRepository->findAll();
        $milieux = $milieuRepository->findAll();
        $agriculteurs = $agriculteurRepository->findAll();

        $form = $this->createFormBuilder($parcelle)
            ->add('surface')
            ->add('irrigation', CheckboxType::class, [
                'label'    => 'Irrigation',
                'required' => false,
            ])
            ->add('compaction', CheckboxType::class, [
                'label'    => 'Compaction',
                'required' => false,
            ])
            ->add('contreSaison', CheckboxType::class, [
                'label'    => 'Contre saison',
                'required' => false,
            ])
            ->add('zoneErodible', CheckboxType::class, [
                'label'    => 'Zone érodible',
                'required' => false,
            ])
            ->add('longitude')
            ->add('latitude')
            ->add('observation')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Complete parcelle with foreign key
            if ($request->request->get('agriculteur')) {
                $parcelle->setAgriculteur($agriculteurRepository->find($request->request->get('agriculteur')));
            }
            if ($request->request->get('type')) {
                $parcelle->setType($typeRepository->find($request->request->get('type')));
            }
            if ($request->request->get('typeSol')) {
                $parcelle->setTypeSol($typeSolRepository->find($request->request->get('typeSol')));
            }
            if ($request->request->get('modeFaireValoir')) {
                $parcelle->setModeFaireValoir($modeFaireValoirRepository->find(
                    $request->request->get('modeFaireValoir')
                ));
            }
            if ($request->request->get('localisation')) {
                $parcelle->setLocalisation($localisationRepository->find(
                    $request->request->get('localisation')
                ));
            }
            if ($request->request->get('milieu')) {
                $parcelle->setMilieu($milieuRepository->find($request->request->get('milieu')));
            }

            $objectManager->persist($parcelle);

            $objectManager->flush();

            return $this->redirectToRoute('detail_parcelle', ['id' => $parcelle->getId()]);
        }

        return $this->render('parcelle/ajoutParcelle.html.twig', [
            'form_parcelle' => $form->createView(),
            'types' => $types,
            'typeSols' => $typeSols,
            'modeFaireValoirs' => $modeFaireValoirs,
            'localisations' => $localisations,
            'milieux' => $milieux,
            'agriculteurs' => $agriculteurs,
            'parcelle' => null,
        ]);
    }

    /**
     * @Route("/parcelle/add/{idAgriculteur}", name="add_parcelle_from_agriculteur")
     */
    public function addFromAgriculteur(
        Request $request,
        ObjectManager $objectManager,
        TypeRepository $typeRepository,
        TypeSolRepository $typeSolRepository,
        ModeFaireValoirRepository $modeFaireValoirRepository,
        LocalisationRepository $localisationRepository,
        MilieuRepository $milieuRepository,
        AgriculteurRepository $agriculteurRepository,
        $idAgriculteur
    ) {

        $parcelle = new Parcelle();

        $types = $typeRepository->findAll();
        $typeSols = $typeSolRepository->findAll();
        $modeFaireValoirs = $modeFaireValoirRepository->findAll();
        $localisations = $localisationRepository->findAll();
        $milieux = $milieuRepository->findAll();

        $form = $this->createFormBuilder($parcelle)
            ->add('surface')
            ->add('irrigation')
            ->add('compaction')
            ->add('contreSaison')
            ->add('zoneErodible')
            ->add('longitude')
            ->add('latitude')
            ->add('observation')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Complete parcelle with foreign key
            $parcelle->setAgriculteur($agriculteurRepository->find($idAgriculteur));

            if ($request->request->get('type')) {
                $parcelle->setType($typeRepository->find($request->request->get('type')));
            }
            if ($request->request->get('typeSol')) {
                $parcelle->setTypeSol($typeSolRepository->find($request->request->get('typeSol')));
            }
            if ($request->request->get('modeFaireValoir')) {
                $parcelle->setModeFaireValoir($modeFaireValoirRepository->find(
                    $request->request->get('modeFaireValoir')
                ));
            }
            if ($request->request->get('localisation')) {
                $parcelle->setLocalisation($localisationRepository->find(
                    $request->request->get('localisation')
                ));
            }
            if ($request->request->get('milieu')) {
                $parcelle->setMilieu($milieuRepository->find($request->request->get('milieu')));
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
            'idAgriculteur'=> $idAgriculteur,
            'agriculteur'=>$agriculteurRepository->find($idAgriculteur),
            'parcelle'=> null,
        ]);
    }

    /**
     * @Route("/parcelle/{id}", name="detail_parcelle")
     */
    public function detail(
        Parcelle $parcelle,
        FumureOrganiqueRepository $fumureOrganiqueRepository,
        InsecticideRepository $insecticideRepository
    ) {
        $fumures = $fumureOrganiqueRepository->findAll();
        $insecticides = $insecticideRepository->findAll();

        return $this->render('parcelle/detailParcelle.html.twig', [
            'parcelle' => $parcelle,
            'fumures' => $fumures,
            'insecticides' => $insecticides,
        ]);
    }

    /**
     * @Route("/parcelle/update/{id}", name="update_parcelle")
     */
    public function update(
        Request $request,
        ObjectManager $objectManager,
        Parcelle $parcelle,
        TypeRepository $typeRepository,
        TypeSolRepository $typeSolRepository,
        ModeFaireValoirRepository $modeFaireValoirRepository,
        LocalisationRepository $localisationRepository,
        MilieuRepository $milieuRepository,
        AgriculteurRepository $agriculteurRepository
    ) {

        $types = $typeRepository->findAll();
        $typeSols = $typeSolRepository->findAll();
        $modeFaireValoirs = $modeFaireValoirRepository->findAll();
        $localisations = $localisationRepository->findAll();
        $milieux = $milieuRepository->findAll();
        $agriculteurs = $agriculteurRepository->findAll();

        $form = $this->createFormBuilder($parcelle)
            ->add('surface')
            ->add('irrigation')
            ->add('compaction')
            ->add('contreSaison')
            ->add('zoneErodible')
            ->add('longitude')
            ->add('latitude')
            ->add('observation')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Complete parcelle with foreign key
            $parcelle->setAgriculteur($agriculteurRepository->find($parcelle->getAgriculteur()->getId()));

            if ($request->request->get('type')) {
                $parcelle->setType($typeRepository->find($request->request->get('type')));
            }
            if ($request->request->get('typeSol')) {
                $parcelle->setTypeSol($typeSolRepository->find($request->request->get('typeSol')));
            }
            if ($request->request->get('modeFaireValoir')) {
                $parcelle->setModeFaireValoir($modeFaireValoirRepository->find(
                    $request->request->get('modeFaireValoir')
                ));
            }
            if ($request->request->get('localisation')) {
                $parcelle->setLocalisation($localisationRepository->find(
                    $request->request->get('localisation')
                ));
            }
            if ($request->request->get('milieu')) {
                $parcelle->setMilieu($milieuRepository->find($request->request->get('milieu')));
            }

            $objectManager->persist($parcelle);

            $objectManager->flush();

            return $this->redirectToRoute('detail_agriculteur', ['id' => $parcelle->getAgriculteur()->getId()]);
        }

        return $this->render('parcelle/ajoutParcelle.html.twig', [
            'form_parcelle' => $form->createView(),
            'types' => $types,
            'typeSols' => $typeSols,
            'modeFaireValoirs' => $modeFaireValoirs,
            'localisations' => $localisations,
            'milieux' => $milieux,
            'agriculteurs'=> $agriculteurs,
            'parcelle'=> $parcelle,
        ]);
    }

    /**
     * @Route("/admin/parcelle/delete/{id}", name="delete_parcelle")
     */
    public function delete(Parcelle $parcelle, ObjectManager $objectManager)
    {
        $objectManager->remove($parcelle);
        $objectManager->flush();
        return $this->redirectToRoute('parcelles');
    }

    /**
     * @Route("/export/parcelle", name="export_parcelle")
     */
    public function exportAction(ParcelleRepository $parcelleRepository)
    {
        $filename = 'Parcelles.xlsx';

        $excelService = new ExcelService();

        $spreadsheet = $excelService->writeParcelle($parcelleRepository);

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
     * @Route("/upload/parcelle", name="upload_parcelle")
     */
    public function upload(
        Request $request,
        ObjectManager $objectManager,
        ParcelleRepository $parcelleRepository,
        TypeRepository $typeRepository,
        TypeSolRepository $typeSolRepository,
        ModeFaireValoirRepository $modeFaireValoirRepository,
        LocalisationRepository $localisationRepository,
        MilieuRepository $milieuRepository,
        AgriculteurRepository $agriculteurRepository
    ) {

        $file = $request->files->get('file');

        try {

            $fileName = 'Parcelle_uploaded'.(microtime(true) * 1000).'.xlsx';

            $file->move($this->getParameter('upload_directory'), $fileName);

            $reader = new ReaderXlsx();
            $reader->setReadDataOnly(true);

            $spreadSheet = $reader->load($this->getParameter('upload_directory') . $fileName);

            $excelService = new ExcelService();

            $row = $excelService->upload($spreadSheet);

            foreach ($row as $r) {
                $parcelle = new Parcelle();
                try {
                    if( strpos($r[0], 'PL_') !== false ) {
                        $r[0] = substr($r[0], 3);
                    }
                    if(intval($r[0]) > 0) {
                        $parcelle = $parcelleRepository->find(intval($r[0]));
                    }
                    if( strpos($r[1], 'AG_') !== false ) {
                        $r[1] = substr($r[0], 3);
                    }
                } catch (\Throwable $th) {
                    //$r[0] is not an int so we add a new instance
                }

                $parcelle->complete($r);

                if ($r[1] != null) {
                    $parcelle->setAgriculteur($agriculteurRepository->find(intVal($r[1])));
                }
                if ($r[3] != null) {
                    $parcelle->setType($typeRepository->findOneByNom($r[3]));
                }
                if ($r[4] != null) {
                    $parcelle->setTypeSol($typeSolRepository->findOneByNom($r[4]));
                }

                if ($r[5] != null) {
                    $parcelle->setModeFaireValoir($modeFaireValoirRepository->findOneByNom($r[5]));
                }

                if ($r[6] != null) {
                    $parcelle->setLocalisation($localisationRepository->findOneByNom($r[6]));
                }

                if ($r[7] != null) {
                    $parcelle->setMilieu($milieuRepository->findOneByNom($r[7]));
                }

                $objectManager->persist($parcelle);

                $objectManager->flush();
            }
        } catch (FileException $e) {
            return $this->redirectToRoute('upload_parcelle_form');
        }

        return $this->redirectToRoute('parcelles');

        // return $this->render('parcelle/upload.html.twig');

        // return $this->redirectToRoute('detail_parcelle', ['id' => $row[2][0]]);

    }

    /**
     * @Route("/upload/parcelle_form", name="upload_parcelle_form")
     */
    public function uploads()
    {
        return $this->render('parcelle/upload.html.twig');
    }

    /**
     * @Route("/map/parcelles", name="map_parcelles")
     */
    public function map(
        ParcelleRepository $parcelleRepository
    ) {
        $parcelles = $parcelleRepository->getForMap();

        return $this->json($parcelles);
    }

    /**
     * @Route("/map/search/parcelle", name="search_parcelle")
     */
    public function search (Request $request, ParcelleRepository $parcelleRepository) {

        $criterya = array();

        $text = null;

        // get research parameter
        if ($request->query->get('text') && $request->query->get('text')!=='' && $request->query->get('text')!==' ') {
            $text = $request->query->get('text');
        }

        if ($request->query->get('irrigation') == 'true') {
            $criterya["irrigation"] = true;
        }
        if ($request->query->get('compaction') == 'true') {
            $criterya["compaction"] = true;
        }
        if ($request->query->get('contre_saison') == 'true') {
            $criterya["contreSaison"] = true;
        }
        if ($request->query->get('zone_erodible') == 'true') {
            $criterya["zoneErodible"] = true;
        }

        $parcelles = [];
        
        $text == null ? $parcelles = $parcelleRepository->findBy($criterya) : $parcelles = $parcelleRepository->globalSearch($text);
        
        $res = array();

        foreach ($parcelles as $a) {

            if($a->getLongitude() == null || $a->getLatitude() == null) {
                continue;
            }

            try {
                if ($a->getIrrigation() !== $criterya["irrigation"]) {
                    continue;
                }
            } catch (\Throwable $th) {}
                
            try {
                if ($a->getCompaction() !== $criterya["compaction"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            try {
                if ($a->getContreSaison() !== $criterya["contreSaison"]) {
                    continue;
                }
            } catch(\Throwable $th){}

            try {
                if ($a->getZoneErodible() !== $criterya["zoneErodible"]) {
                    continue;
                }
            } catch(\Throwable $th){}
            
            $res[] = [
                "id" => $a->getId(),
                "agriculteur_id" => $a->getAgriculteur()->getId(),
                "longitude" => $a->getLongitude(),
                "latitude" => $a->getLatitude(),
            ];
        }

        return $this->json( $res);
    }
}
