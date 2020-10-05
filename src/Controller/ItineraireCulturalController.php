<?php

namespace App\Controller;

use App\Entity\ItineraireCultural;
use App\Repository\ItineraireCulturalRepository;
use App\Repository\SystemeCulturalRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ItineraireCulturalController extends AbstractController
{
    /**
     * @Route("/itineraire_culturals", name="itineraire_cultural")
     */
    public function index(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        ItineraireCulturalRepository $itineraireCulturalRepository,
        SystemeCulturalRepository $systemeCulturalRepository
    ) {
        $itineraireCultural = new ItineraireCultural();

        $systemes = $systemeCulturalRepository->findAll();

        $form = $this->createFormBuilder($itineraireCultural)
            ->add('nom')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // if ($request->request->get('foreign')) {
            //     $itineraireCultural->setSysteme($systemeCulturalRepository
            //         ->find($request->request->get('foreign')));
            // }

            $objectManager->persist($itineraireCultural);
            $objectManager->flush();

            return $this->redirect($request->getUri());
        }

        $itineraireCulturals = $itineraireCulturalRepository->findAll();

        return $this->render('itineraire_cultural/index.html.twig', [
            'bases' => $itineraireCulturals,
            'base' => $itineraireCultural,
            'foreigns' => $systemes,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/itineraire_cultural/update/{id}", name="update_itineraire_cultural")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        ItineraireCulturalRepository $itineraireCulturalRepository,
        SystemeCulturalRepository $systemeCulturalRepository,
        ItineraireCultural $itineraireCultural
    ) {

        $systemes = $systemeCulturalRepository->findAll();

        $form = $this->createFormBuilder($itineraireCultural)
            ->add('nom')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // if ($request->request->get('foreign')) {
            //     $itineraireCultural->setSysteme($systemeCulturalRepository
            //         ->find($request->request->get('foreign')));
            // }

            $objectManager->persist($itineraireCultural);
            $objectManager->flush();

            return $this->redirectToRoute('itineraire_cultural');
        }

        $itineraireCulturals = $itineraireCulturalRepository->findAll();

        return $this->render('itineraire_cultural/index.html.twig', [
            'bases' => $itineraireCulturals,
            'base' => $itineraireCultural,
            'foreigns' => $systemes,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/itineraire_cultural/delete/{id}", name="delete_itineraire_cultural")
     */
    public function delete(ItineraireCultural $itineraireCultural, ObjectManager $objectManager)
    {
        $objectManager->remove($itineraireCultural);
        $objectManager->flush();
        return $this->redirectToRoute('itineraire_cultural');
    }
}
