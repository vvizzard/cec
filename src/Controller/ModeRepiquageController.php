<?php

namespace App\Controller;

use App\Entity\ModeRepiquage;
use App\Repository\ModeRepiquageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ModeRepiquageController extends AbstractController
{
    /**
     * @Route("/mode_repiquages", name="mode_repiquage")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, ModeRepiquageRepository $modeRepiquageRepository)
    {
        $modeRepiquage = new ModeRepiquage();

        $form = $this->createFormBuilder($modeRepiquage)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($modeRepiquage);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $modeRepiquages = $modeRepiquageRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'ModeRepiquage',
            'bases' => $modeRepiquages,
            'base_form' => $form->createView(),
        ]);
    }
}
