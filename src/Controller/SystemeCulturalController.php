<?php

namespace App\Controller;

use App\Entity\SystemeCultural;
use App\Repository\MilieuRepository;
use App\Repository\SystemeCulturalRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class SystemeCulturalController extends AbstractController
{
    /**
     * @Route("/systeme_culturals", name="systeme_cultural")
     */
    public function index(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        SystemeCulturalRepository $systemeCulturalRepository,
        MilieuRepository $milieuRepository
    ) {
        $systemeCultural = new SystemeCultural();

        $milieux = $milieuRepository->findAll();

        $form = $this->createFormBuilder($systemeCultural)
            ->add('nom')
            ->add('systemeCulturalExport')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->get('foreign')) {
                $systemeCultural->setMilieu($milieuRepository->find($request->request->get('foreign')));
            }

            $objectManager->persist($systemeCultural);
            $objectManager->flush();

            return $this->redirect($request->getUri());
        }

        $systemeCulturals = $systemeCulturalRepository->findAll();

        return $this->render('systeme_cultural/index.html.twig', [
            'bases' => $systemeCulturals,
            'base' => $systemeCultural,
            'foreigns' => $milieux,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/systeme_cultural/update/{id}", name="update_systeme_cultural")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        SystemeCulturalRepository $systemeCulturalRepository,
        MilieuRepository $milieuRepository,
        SystemeCultural $systemeCultural
    ) {

        $milieux = $milieuRepository->findAll();

        $form = $this->createFormBuilder($systemeCultural)
            ->add('nom')
            ->add('systemeCulturalExport')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->get('foreign')) {
                $systemeCultural->setMilieu($milieuRepository->find($request->request->get('foreign')));
            }

            $objectManager->persist($systemeCultural);
            $objectManager->flush();

            return $this->redirectToRoute('systeme_cultural');
        }

        $systemeCulturals = $systemeCulturalRepository->findAll();

        return $this->render('systeme_cultural/index.html.twig', [
            'bases' => $systemeCulturals,
            'base' => $systemeCultural,
            'foreigns' => $milieux,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/systeme_cultural/delete/{id}", name="delete_systeme_cultural")
     */
    public function delete(SystemeCultural $systemeCultural, ObjectManager $objectManager)
    {
        $objectManager->remove($systemeCultural);
        $objectManager->flush();
        return $this->redirectToRoute('systeme_cultural');
    }
}
