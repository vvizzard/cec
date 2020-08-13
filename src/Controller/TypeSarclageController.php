<?php

namespace App\Controller;

use App\Entity\TypeSarclage;
use App\Repository\TypeSarclageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TypeSarclageController extends AbstractController
{
    /**
     * @Route("/type_sarclages", name="type_sarclage")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TypeSarclageRepository $typeSarclageRepository)
    {
        $typeSarclage = new TypeSarclage();

        $form = $this->createFormBuilder($typeSarclage)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($typeSarclage);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $typeSarclages = $typeSarclageRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'TypeSarclage',
            'bases' => $typeSarclages,
            'base_form' => $form->createView(),
        ]);
    }
}
