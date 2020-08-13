<?php

namespace App\Controller;

use App\Entity\Terroir;
use App\Repository\TerroirRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TerroirController extends AbstractController
{
    /**
     * @Route("/terroirs", name="terroir")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TerroirRepository $terroirRepository)
    {
        $terroir = new Terroir();

        $form = $this->createFormBuilder($terroir)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($terroir);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $terroirs = $terroirRepository->findAll();

        return $this->render('terroir/index.html.twig', [
            'terroirs' => $terroirs,
            'terroir_form' => $form->createView(),
        ]);
    }
}
