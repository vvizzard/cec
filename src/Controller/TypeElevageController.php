<?php

namespace App\Controller;

use App\Entity\TypeElevage;
use App\Repository\TypeElevageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class TypeElevageController extends AbstractController
{
    /**
     * @Route("/type_elevages", name="type_elevage")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, TypeElevageRepository $typeElevageRepository)
    {
        $typeElevage = new TypeElevage();

        $form = $this->createFormBuilder($typeElevage)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($typeElevage);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $typeElevages = $typeElevageRepository->findAll();

        return $this->render('type_elevage/index.html.twig', [
            'typeElevages' => $typeElevages,
            'typeElevage_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/type_elevage/update/{id}", name="update_type_elevage")
     */
    public function update(
        HttpFoundationRequest $request, 
        ObjectManager $objectManager, 
        TypeElevageRepository $typeElevageRepository,
        TypeElevage $typeElevage)
    {

        $form = $this->createFormBuilder($typeElevage)
                     ->add('nom')
                     ->add('description')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($typeElevage);
            $objectManager->flush();
            return $this->redirectToRoute('type_elevage');
        }

        $typeElevages = $typeElevageRepository->findAll();

        return $this->render('type_elevage/index.html.twig', [
            'typeElevages' => $typeElevages,
            'typeElevage_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/type_elevage/delete/{id}", name="delete_type_elevage")
     */
    public function delete(TypeElevage $typeElevage, ObjectManager $objectManager)
    {
        $objectManager->remove($typeElevage);
        $objectManager->flush();
        return $this->redirectToRoute('type_elevage');
    }
}
