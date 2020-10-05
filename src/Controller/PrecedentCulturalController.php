<?php

namespace App\Controller;

use App\Entity\PrecedentCultural;
use App\Repository\PrecedentCulturalRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class PrecedentCulturalController extends AbstractController
{
    /**
     * @Route("/precedent_culturals", name="precedent_cultural")
     */
    public function index(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        PrecedentCulturalRepository $precedentCulturalRepository
    ) {
        $precedentCultural = new PrecedentCultural();

        $form = $this->createFormBuilder($precedentCultural)
            ->add('nom')
            ->add('installeSurPDT', CheckboxType::class, [
                'label'    => 'Installé sur PDT',
                'required' => false,
            ])
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

    /**
     * @Route("/precedent_cultural/update/{id}", name="udpate_precedent_cultural")
     */
    public function udpate(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        PrecedentCulturalRepository $precedentCulturalRepository,
        PrecedentCultural $precedentCultural
    ) {

        $form = $this->createFormBuilder($precedentCultural)
            ->add('nom')
            ->add('installeSurPDT', CheckboxType::class, [
                'label'    => 'Installé sur PDT',
                'required' => false,
            ])
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($precedentCultural);
            $objectManager->flush();
            return $this->redirectToRoute('precedent_cultural');
        }

        $precedentCulturals = $precedentCulturalRepository->findAll();

        return $this->render('precedent_cultural/index.html.twig', [
            'precedentCulturals' => $precedentCulturals,
            'precedentCultural_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/precedent_cultural/delete/{id}", name="delete_precedent_cultural")
     */
    public function delete(PrecedentCultural $precedentCultural, ObjectManager $objectManager)
    {
        $objectManager->remove($precedentCultural);
        $objectManager->flush();
        return $this->redirectToRoute('precedent_cultural');
    }
}
