<?php

namespace App\Controller;

use App\Entity\EquipementAgricole;
use App\Repository\EquipementAgricoleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class EquipementAgricoleController extends AbstractController
{
    /**
     * @Route("/equipement_agricoles", name="equipement_agricole")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, EquipementAgricoleRepository $equipementAgricoleRepository)
    {
        $equipementAgricole = new EquipementAgricole();

        $form = $this->createFormBuilder($equipementAgricole)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($equipementAgricole);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $equipementAgricoles = $equipementAgricoleRepository->findAll();

        return $this->render('equipement_agricole/index.html.twig', [
            'equipementAgricoles' => $equipementAgricoles,
            'equipementAgricole_form' => $form->createView(),
        ]);
    }
}
