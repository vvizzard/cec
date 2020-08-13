<?php

namespace App\Controller;

use App\Entity\CycleAgricole;
use App\Repository\CycleAgricoleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class CycleAgricoleController extends AbstractController
{
    /**
     * @Route("/cycle_agricoles", name="cycle_agricole")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, CycleAgricoleRepository $cycleAgricoleRepository)
    {
        $cycleAgricole = new CycleAgricole();

        $form = $this->createFormBuilder($cycleAgricole)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($cycleAgricole);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $cycleAgricoles = $cycleAgricoleRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'CycleAgricole',
            'bases' => $cycleAgricoles,
            'base_form' => $form->createView(),
        ]);
    }
}
