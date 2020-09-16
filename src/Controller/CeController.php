<?php

namespace App\Controller;

use App\Entity\Ce;
use App\Repository\CeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class CeController extends AbstractController
{
    /**
     * @Route("/ces", name="ce")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, CeRepository $ceRepository)
    {
        $ce = new Ce();

        $form = $this->createFormBuilder($ce)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($ce);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $ces = $ceRepository->findAll();

        return $this->render('ce/index.html.twig', [
            'ces' => $ces,
            'ce_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ce/update/{id}", name="update_ce")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CeRepository $ceRepository,
        Ce $ce
    ) {

        $form = $this->createFormBuilder($ce)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($ce);
            $objectManager->flush();
            return $this->redirectToRoute('ce');
        }

        $ces = $ceRepository->findAll();

        return $this->render('ce/index.html.twig', [
            'ces' => $ces,
            'ce_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/ce/delete/{id}", name="delete_ce")
     */
    public function delete(Ce $ce, ObjectManager $objectManager)
    {
        $objectManager->remove($ce);
        $objectManager->flush();
        return $this->redirectToRoute('ce');
    }
}
