<?php

namespace App\Controller;

use App\Entity\FumureOrganique;
use App\Repository\FumureOrganiqueRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class FumureOrganiqueController extends AbstractController
{
    /**
     * @Route("/fumure_organiques", name="fumure_organique")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, FumureOrganiqueRepository $fumureOrganiqueRepository)
    {
        $fumureOrganique = new FumureOrganique();

        $form = $this->createFormBuilder($fumureOrganique)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($fumureOrganique);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $fumureOrganiques = $fumureOrganiqueRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'FumureOrganique',
            'bases' => $fumureOrganiques,
            'base_form' => $form->createView(),
        ]);
    }
}
