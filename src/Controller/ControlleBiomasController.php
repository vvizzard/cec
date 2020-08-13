<?php

namespace App\Controller;

use App\Entity\ControlleBiomas;
use App\Repository\ControlleBiomasRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ControlleBiomasController extends AbstractController
{
    /**
     * @Route("/controlle_biomas", name="controlle_biomas")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, ControlleBiomasRepository $controlleBiomasRepository)
    {
        $controlleBiomas = new ControlleBiomas();

        $form = $this->createFormBuilder($controlleBiomas)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($controlleBiomas);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $controlleBiomass = $controlleBiomasRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'ControlleBiomas',
            'bases' => $controlleBiomass,
            'base_form' => $form->createView(),
        ]);
    }
}
