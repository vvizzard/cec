<?php

namespace App\Controller;

use App\Entity\EmplacementPI;
use App\Repository\EmplacementPIRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class EmplacementPIController extends AbstractController
{
    /**
     * @Route("/emplacement_p_is", name="emplacement_p_i")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, EmplacementPIRepository $emplacementPIRepository)
    {
        $emplacementPI = new EmplacementPI();

        $form = $this->createFormBuilder($emplacementPI)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($emplacementPI);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $emplacementPIs = $emplacementPIRepository->findAll();

        return $this->render('emplacement_pi/index.html.twig', [
            'emplacementPIs' => $emplacementPIs,
            'emplacementPI_form' => $form->createView(),
        ]);
    }
}
