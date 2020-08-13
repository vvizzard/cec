<?php

namespace App\Controller;

use App\Entity\PreparationParcelle;
use App\Repository\PreparationParcelleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class PreparationParcelleController extends AbstractController
{
    /**
     * @Route("/preparation_parcelles", name="preparation_parcelle")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, PreparationParcelleRepository $preparationParcelleRepository)
    {
        $preparationParcelle = new PreparationParcelle();

        $form = $this->createFormBuilder($preparationParcelle)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($preparationParcelle);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $preparationParcelles = $preparationParcelleRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'PreparationParcelle',
            'bases' => $preparationParcelles,
            'base_form' => $form->createView(),
        ]);
    }
}
