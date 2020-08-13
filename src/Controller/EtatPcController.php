<?php

namespace App\Controller;

use App\Entity\EtatPc;
use App\Repository\EtatPcRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class EtatPcController extends AbstractController
{
    /**
     * @Route("/etat_pcs", name="etat_pc")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, EtatPcRepository $etatPcRepository)
    {
        $etatPc = new EtatPc();

        $form = $this->createFormBuilder($etatPc)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($etatPc);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $etatPcs = $etatPcRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'EtatPc',
            'bases' => $etatPcs,
            'base_form' => $form->createView(),
        ]);
    }
}
