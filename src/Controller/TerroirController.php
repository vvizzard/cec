<?php

namespace App\Controller;

use App\Entity\Terroir;
use App\Repository\TerroirRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TerroirController extends AbstractController
{
    /**
     * @Route("/terroirs", name="terroir")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TerroirRepository $terroirRepository)
    {
        $terroir = new Terroir();

        $form = $this->createFormBuilder($terroir)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($terroir);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $terroirs = $terroirRepository->findAll();

        return $this->render('terroir/index.html.twig', [
            'terroirs' => $terroirs,
            'terroir_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/fokontany/{id}", name="update_fokontany")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        TerroirRepository $terroirRepository,
        Terroir $terroir
    ) {

        $form = $this->createFormBuilder($terroir)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($terroir);
            $objectManager->flush();
            return $this->redirectToRoute('terroir');
        }

        $terroirs = $terroirRepository->findAll();

        return $this->render('terroir/index.html.twig', [
            'terroirs' => $terroirs,
            'terroir' => $terroir,
            'terroir_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/fokontany/delete/{id}", name="delete_fokontany")
     */
    public function delete(Terroir $fokontany, ObjectManager $objectManager)
    {
        $objectManager->remove($fokontany);
        $objectManager->flush();
        return $this->redirectToRoute('terroir');
    }
}
