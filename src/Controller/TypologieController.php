<?php

namespace App\Controller;

use App\Entity\Typologie;
use App\Repository\TypologieRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TypologieController extends AbstractController
{
    /**
     * @Route("/typologies", name="typologie")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TypologieRepository $typologieRepository)
    {
        $typologie = new Typologie();

        $form = $this->createFormBuilder($typologie)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($typologie);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $typologies = $typologieRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'Typologie',
            'bases' => $typologies,
            'base_form' => $form->createView(),
        ]);
    }
}
