<?php

namespace App\Controller;

use App\Entity\ModeInstallation;
use App\Repository\ModeInstallationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ModeInstallationController extends AbstractController
{
    /**
     * @Route("/mode_installations", name="mode_installation")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, ModeInstallationRepository $modeInstallationRepository)
    {
        $modeInstallation = new ModeInstallation();

        $form = $this->createFormBuilder($modeInstallation)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($modeInstallation);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $modeInstallations = $modeInstallationRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'ModeInstallation',
            'bases' => $modeInstallations,
            'base_form' => $form->createView(),
        ]);
    }
}
