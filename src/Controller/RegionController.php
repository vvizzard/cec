<?php

namespace App\Controller;

use App\Entity\Region;
use App\Repository\RegionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class RegionController extends AbstractController
{
    /**
     * @Route("/regions", name="region")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, RegionRepository $regionRepository)
    {
        $region = new Region();

        $form = $this->createFormBuilder($region)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($region);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $regions = $regionRepository->findAll();

        return $this->render('region/index.html.twig', [
            'regions' => $regions,
            'region_form' => $form->createView(),
        ]);
    }
}
