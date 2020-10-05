<?php

namespace App\Controller;

use App\Entity\SousRegion;
use App\Repository\RegionRepository;
use App\Repository\SousRegionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class SousRegionController extends AbstractController
{
    /**
     * @Route("/sous_regions", name="sous_Region")
     */
    public function index(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        SousRegionRepository $sousRegionRepository,
        RegionRepository $regionRepository
    ) {
        $sousRegion = new SousRegion();

        $regions = $regionRepository->findAll();

        $form = $this->createFormBuilder($sousRegion)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->get('region')) {
                $sousRegion->setRegion($regionRepository->find($request->request->get('region')));
            }

            $objectManager->persist($sousRegion);
            $objectManager->flush();

            return $this->redirect($request->getUri());
        }

        $sousRegions = $sousRegionRepository->findAll();

        return $this->render('sous_region/index.html.twig', [
            'sousRegions' => $sousRegions,
            'sousRegion' => $sousRegion,
            'regions' => $regions,
            'sousRegion_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/district/update/{id}", name="update_district")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        SousRegionRepository $sousRegionRepository,
        RegionRepository $regionRepository,
        SousRegion $sousRegion
    ) {

        $regions = $regionRepository->findAll();

        $form = $this->createFormBuilder($sousRegion)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->get('region')) {
                $sousRegion->setRegion($regionRepository->find($request->request->get('region')));
            }

            $objectManager->persist($sousRegion);
            $objectManager->flush();

            return $this->redirectToRoute('sous_Region');
        }

        $sousRegions = $sousRegionRepository->findAll();

        return $this->render('sous_region/index.html.twig', [
            'sousRegions' => $sousRegions,
            'sousRegion' => $sousRegion,
            'regions' => $regions,
            'sousRegion_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/district/delete/{id}", name="delete_district")
     */
    public function delete(SousRegion $sousRegion, ObjectManager $objectManager)
    {
        $objectManager->remove($sousRegion);
        $objectManager->flush();
        return $this->redirectToRoute('sous_Region');
    }
}
