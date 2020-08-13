<?php

namespace App\Controller;

use App\Entity\Bvpi;
use App\Repository\BvpiRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class BvpiController extends AbstractController
{
    /**
     * @Route("/bvpis", name="bvpi")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, BvpiRepository $bvpiRepository)
    {
        $bvpi = new Bvpi();

        $form = $this->createFormBuilder($bvpi)
                     ->add('nom')
                     ->add('numero')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($bvpi);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $bvpis = $bvpiRepository->findAll();

        return $this->render('bvpi/index.html.twig', [
            'bvpis' => $bvpis,
            'bvpi_form' => $form->createView(),
        ]);
    }
}
