<?php

namespace App\Controller;

use App\Entity\Village;
use App\Repository\VillageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class VillageController extends AbstractController
{
    /**
     * @Route("/villages", name="village")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, VillageRepository $villageRepository)
    {
        $village = new Village();

        $form = $this->createFormBuilder($village)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($village);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $villages = $villageRepository->findAll();

        return $this->render('village/index.html.twig', [
            'villages' => $villages,
            'village_form' => $form->createView(),
        ]);
    }
}
