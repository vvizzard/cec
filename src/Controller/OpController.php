<?php

namespace App\Controller;

use App\Entity\Op;
use App\Repository\OpRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class OpController extends AbstractController
{
    /**
     * @Route("/ops", name="op")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, OpRepository $opRepository)
    {
        $op = new Op();

        $form = $this->createFormBuilder($op)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($op);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $ops = $opRepository->findAll();

        return $this->render('op/index.html.twig', [
            'ops' => $ops,
            'op_form' => $form->createView(),
        ]);
    }
}
