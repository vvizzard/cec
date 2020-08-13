<?php

namespace App\Controller;

use App\Entity\AncienneteAgriculteur;
use App\Repository\AncienneteAgriculteurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class AncienneteAgriculteurController extends AbstractController
{
    /**
     * @Route("/anciennete_agriculteurs", name="ancienneteAgriculteur")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, AncienneteAgriculteurRepository $ancienneteAgriculteurRepository)
    {
        $ancienneteAgriculteur = new AncienneteAgriculteur();

        $form = $this->createFormBuilder($ancienneteAgriculteur)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($ancienneteAgriculteur);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $ancienneteAgriculteurs = $ancienneteAgriculteurRepository->findAll();

        return $this->render('anciennete_agriculteur/index.html.twig', [
            'ancienneteAgriculteurs' => $ancienneteAgriculteurs,
            'ancienneteAgriculteur_form' => $form->createView(),
        ]);
    }
}
