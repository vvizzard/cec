<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/types", name="type")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TypeRepository $typeRepository)
    {
        $type = new Type();

        $form = $this->createFormBuilder($type)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($type);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $types = $typeRepository->findAll();

        return $this->render('type/index.html.twig', [
            'types' => $types,
            'type_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/type/update/{id}", name="update_type")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        TypeRepository $typeRepository,
        Type $type
    ) {

        $form = $this->createFormBuilder($type)
            ->add('nom')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($type);
            $objectManager->flush();
            return $this->redirectToRoute('type');
        }

        $types = $typeRepository->findAll();

        return $this->render('type/index.html.twig', [
            'types' => $types,
            'type_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/type/delete/{id}", name="delete_type")
     */
    public function delete(Type $type, ObjectManager $objectManager)
    {
        $objectManager->remove($type);
        $objectManager->flush();
        return $this->redirectToRoute('type');
    }
}
