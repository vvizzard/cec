<?php

namespace App\Controller;

use App\Entity\ZoneTechnicien;
use App\Repository\ZoneTechnicienRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class ZoneTechnicienController extends AbstractController
{
    /**
     * @Route("/zone_techniciens", name="zone_technicien")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, ZoneTechnicienRepository $zoneTechnicienRepository)
    {
        $zoneTechnicien = new ZoneTechnicien();

        $form = $this->createFormBuilder($zoneTechnicien)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($zoneTechnicien);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $zoneTechniciens = $zoneTechnicienRepository->findAll();

        return $this->render('zone_technicien/index.html.twig', [
            'zoneTechniciens' => $zoneTechniciens,
            'zoneTechnicien_form' => $form->createView(),
        ]);
    }
}
