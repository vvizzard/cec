<?php

namespace App\Controller;

use App\Entity\Anciennete;
use App\Repository\AncienneteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class AncienneteController extends AbstractController
{
    /**
     * @Route("/anciennetes", name="anciennete")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, AncienneteRepository $ancienneteRepository)
    {
        $anciennete = new Anciennete();

        $form = $this->createFormBuilder($anciennete)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($anciennete);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $anciennetes = $ancienneteRepository->findAll();

        return $this->render('anciennete/index.html.twig', [
            'anciennetes' => $anciennetes,
            'anciennete_form' => $form->createView(),
        ]);
    }
}
