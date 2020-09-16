<?php

namespace App\Controller;

use App\Entity\TypeSol;
use App\Repository\TypeSolRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TypeSolController extends AbstractController
{
    /**
     * @Route("/type_sols", name="type_sol")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TypeSolRepository $typeSolRepository)
    {
        $typeSol = new TypeSol();

        $form = $this->createFormBuilder($typeSol)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($typeSol);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $typeSols = $typeSolRepository->findAll();

        return $this->render('type_sol/index.html.twig', [
            'typeSols' => $typeSols,
            'typeSol_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/type_sol/update/{id}", name="update_type_sol")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        TypeSolRepository $typeSolRepository,
        TypeSol $typeSol
    ) {

        $form = $this->createFormBuilder($typeSol)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($typeSol);
            $objectManager->flush();
            return $this->redirectToRoute('type_sol');
        }

        $typeSols = $typeSolRepository->findAll();

        return $this->render('type_sol/index.html.twig', [
            'typeSols' => $typeSols,
            'typeSol_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/type_sol/delete/{id}", name="delete_type_sol")
     */
    public function delete(TypeSol $type_sol, ObjectManager $objectManager)
    {
        $objectManager->remove($type_sol);
        $objectManager->flush();
        return $this->redirectToRoute('type_sol');
    }
}
