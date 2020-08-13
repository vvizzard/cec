<?php

namespace App\Controller;

use App\Entity\EtatMulch;
use App\Repository\EtatMulchRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class EtatMulchController extends AbstractController
{
    /**
     * @Route("/etat_mulchs", name="etat_mulch")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, EtatMulchRepository $etatMulchRepository)
    {
        $etatMulch = new EtatMulch();

        $form = $this->createFormBuilder($etatMulch)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($etatMulch);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $etatMulchs = $etatMulchRepository->findAll();

        return $this->render('form_secondaire/index.html.twig', [
            'titre' => 'EtatMulch',
            'bases' => $etatMulchs,
            'base_form' => $form->createView(),
        ]);
    }
}
