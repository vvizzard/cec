<?php

namespace App\Controller;

use App\Entity\ModeFaireValoir;
use App\Repository\ModeFaireValoirRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ModeFaireValoirController extends AbstractController
{
    /**
     * @Route("/mode_faire_valoirs", name="mode_faire_valoir")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, ModeFaireValoirRepository $modeFaireValoirRepository)
    {
        $modeFaireValoir = new ModeFaireValoir();

        $form = $this->createFormBuilder($modeFaireValoir)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($modeFaireValoir);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $modeFaireValoirs = $modeFaireValoirRepository->findAll();

        return $this->render('mode_faire_valoir/index.html.twig', [
            'modeFaireValoirs' => $modeFaireValoirs,
            'modeFaireValoir_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mode_faire_valoir/update/{id}", name="update_mode_faire_valoir")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        ModeFaireValoirRepository $modeFaireValoirRepository,
        ModeFaireValoir $modeFaireValoir
    ) {

        $form = $this->createFormBuilder($modeFaireValoir)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($modeFaireValoir);
            $objectManager->flush();
            return $this->redirectToRoute('mode_faire_valoir');
        }

        $modeFaireValoirs = $modeFaireValoirRepository->findAll();

        return $this->render('mode_faire_valoir/index.html.twig', [
            'modeFaireValoirs' => $modeFaireValoirs,
            'modeFaireValoir_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/mode_faire_valoir/delete/{id}", name="delete_mode_faire_valoir")
     */
    public function delete(ModeFaireValoir $modeFaireValoir, ObjectManager $objectManager)
    {
        $objectManager->remove($modeFaireValoir);
        $objectManager->flush();
        return $this->redirectToRoute('mode_faire_valoir');
    }
}
