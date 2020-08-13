<?php

namespace App\Controller;

use App\Entity\PrecedentCultural;
use App\Repository\PrecedentCulturalRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class PrecedentCulturalController extends AbstractController
{
    /**
     * @Route("/precedent_culturals", name="precedent_cultural")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, 
            PrecedentCulturalRepository $precedentCulturalRepository)
    {
        $precedentCultural = new PrecedentCultural();

        $form = $this->createFormBuilder($precedentCultural)
                     ->add('nom')
                     ->add('installeSurPDT')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($precedentCultural);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $precedentCulturals = $precedentCulturalRepository->findAll();

        return $this->render('precedent_cultural/index.html.twig', [
            'precedentCulturals' => $precedentCulturals,
            'precedentCultural_form' => $form->createView(),
        ]);
    }
}
