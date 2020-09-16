<?php

namespace App\Controller;

use App\Entity\Localisation;
use App\Repository\LocalisationRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class LocalisationController extends AbstractController
{
    /**
     * @Route("/localisations", name="localisation")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, LocalisationRepository $localisationRepository)
    {
        $localisation = new Localisation();

        $form = $this->createFormBuilder($localisation)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($localisation);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $localisations = $localisationRepository->findAll();

        return $this->render('localisation/index.html.twig', [
            'localisations' => $localisations,
            'localisation_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/localisation/update/{id}", name="update_localisation")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        LocalisationRepository $localisationRepository,
        Localisation $localisation
    ) {

        $form = $this->createFormBuilder($localisation)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($localisation);
            $objectManager->flush();
            return $this->redirectToRoute('localisation');
        }

        $localisations = $localisationRepository->findAll();

        return $this->render('localisation/index.html.twig', [
            'localisations' => $localisations,
            'localisation_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/localisation/delete/{id}", name="delete_localisation")
     */
    public function delete(Localisation $localisation, ObjectManager $objectManager)
    {
        $objectManager->remove($localisation);
        $objectManager->flush();
        return $this->redirectToRoute('localisation');
    }
}
