<?php

namespace App\Controller;

use App\Entity\Variete;
use App\Repository\CultureRepository;
use App\Repository\VarieteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class VarieteController extends AbstractController
{
    /**
     * @Route("/varietes", name="variete")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, 
            VarieteRepository $varieteRepository, CultureRepository $cultureRepository)
    {
        $variete = new Variete();

        $cultures = $cultureRepository->findAll();

        $form = $this->createFormBuilder($variete)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if($request->request->get('foreign')) {
                $variete->setCulture($cultureRepository->find($request->request->get('foreign')));
            }

            $objectManager->persist($variete);
            $objectManager->flush();

            return $this->redirect($request->getUri());
        }

        $varietes = $varieteRepository->findAll();

        return $this->render('variete/index.html.twig', [
            'bases' => $varietes,
            'foreigns' => $cultures,
            'base_form' => $form->createView(),
        ]);
    }
}
