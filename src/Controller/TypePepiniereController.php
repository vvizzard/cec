<?php

namespace App\Controller;

use App\Entity\TypePepiniere;
use App\Repository\TypePepiniereRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TypePepiniereController extends AbstractController
{
    /**
     * @Route("/type_pepinieres", name="type_pepiniere")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TypePepiniereRepository $typePepiniereRepository)
    {
        $typePepiniere = new TypePepiniere();

        $form = $this->createFormBuilder($typePepiniere)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($typePepiniere);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $typePepinieres = $typePepiniereRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'TypePepiniere',
            'bases' => $typePepinieres,
            'base_form' => $form->createView(),
        ]);
    }
}
