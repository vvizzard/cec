<?php

namespace App\Controller;

use App\Entity\Insecticide;
use App\Repository\InsecticideRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class InsecticideController extends AbstractController
{
    /**
     * @Route("/insecticides", name="insecticide")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, InsecticideRepository $insecticideRepository)
    {
        $insecticide = new Insecticide();

        $form = $this->createFormBuilder($insecticide)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($insecticide);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $insecticides = $insecticideRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'Insecticide',
            'bases' => $insecticides,
            'base_form' => $form->createView(),
        ]);
    }
}
