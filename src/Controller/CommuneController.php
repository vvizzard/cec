<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Repository\CommuneRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class CommuneController extends AbstractController
{
    /**
     * @Route("/communes", name="commune")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, CommuneRepository $communeRepository)
    {
        $commune = new Commune();

        $form = $this->createFormBuilder($commune)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($commune);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $communes = $communeRepository->findAll();

        return $this->render('commune/index.html.twig', [
            'communes' => $communes,
            'commune_form' => $form->createView(),
        ]);
    }
}
