<?php

namespace App\Controller;

use App\Entity\SondageQualitatif;
use App\Repository\SondageQualitatifRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class SondageQualitatifController extends AbstractController
{
    /**
     * @Route("/sondage_qualitatifs", name="sondage_qualitatif")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, SondageQualitatifRepository $sondageQualitatifRepository)
    {
        $sondageQualitatif = new SondageQualitatif();

        $form = $this->createFormBuilder($sondageQualitatif)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($sondageQualitatif);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $sondageQualitatifs = $sondageQualitatifRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'SondageQualitatif',
            'bases' => $sondageQualitatifs,
            'base_form' => $form->createView(),
        ]);
    }
}
