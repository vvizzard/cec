<?php

namespace App\Controller;

use App\Entity\Elevage;
use App\Repository\ElevageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ElevageController extends AbstractController
{
    /**
     * @Route("/elevages", name="elevage")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, ElevageRepository $elevageRepository)
    {
        $elevage = new Elevage();

        $form = $this->createFormBuilder($elevage)
                     ->add('nom')
                     ->add('rente')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($elevage);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $elevages = $elevageRepository->findAll();

        return $this->render('elevage/index.html.twig', [
            'elevages' => $elevages,
            'elevage_form' => $form->createView(),
        ]);
    }
}
