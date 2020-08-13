<?php

namespace App\Controller;

use App\Entity\Milieu;
use App\Repository\MilieuRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class MilieuController extends AbstractController
{
    /**
     * @Route("/milieux", name="milieu")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, MilieuRepository $milieuRepository)
    {
        $milieu = new Milieu();

        $form = $this->createFormBuilder($milieu)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($milieu);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $milieus = $milieuRepository->findAll();

        return $this->render('milieu/index.html.twig', [
            'milieus' => $milieus,
            'milieu_form' => $form->createView(),
        ]);
    }
}
