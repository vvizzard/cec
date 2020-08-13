<?php

namespace App\Controller;

use App\Entity\DegatCyclonique;
use App\Repository\DegatCycloniqueRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class DegatCycloniqueController extends AbstractController
{
    /**
     * @Route("/degat_cycloniques", name="degat_cyclonique")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, DegatCycloniqueRepository $degatCycloniqueRepository)
    {
        $degatCyclonique = new DegatCyclonique();

        $form = $this->createFormBuilder($degatCyclonique)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($degatCyclonique);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $degatCycloniques = $degatCycloniqueRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'DegatCyclonique',
            'bases' => $degatCycloniques,
            'base_form' => $form->createView(),
        ]);
    }
}
