<?php

namespace App\Controller;

use App\Entity\ZC;
use App\Repository\ZCRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ZcController extends AbstractController
{
    /**
     * @Route("/zcs", name="zc")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, ZCRepository $zCRepository)
    {
        $zC = new ZC();

        $form = $this->createFormBuilder($zC)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($zC);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $zCs = $zCRepository->findAll();

        return $this->render('zC/index.html.twig', [
            'zCs' => $zCs,
            'zC_form' => $form->createView(),
        ]);
    }
}
