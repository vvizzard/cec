<?php

namespace App\Controller;

use App\Entity\AgePlant;
use App\Repository\AgePlantRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class AgePlantController extends AbstractController
{
    /**
     * @Route("/age_plants", name="age_plant")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, AgePlantRepository $agePlantRepository)
    {
        $agePlant = new AgePlant();

        $form = $this->createFormBuilder($agePlant)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($agePlant);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $agePlants = $agePlantRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'AgePlant',
            'bases' => $agePlants,
            'base_form' => $form->createView(),
        ]);
    }
}
