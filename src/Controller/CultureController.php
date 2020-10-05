<?php

namespace App\Controller;

use App\Entity\Culture;
use App\Repository\CultureRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class CultureController extends AbstractController
{
    /**
     * @Route("/cultures", name="culture")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, CultureRepository $cultureRepository)
    {
        $culture = new Culture();

        $form = $this->createFormBuilder($culture)
            ->add('nom')
            ->add('rente', CheckboxType::class, [
                'label'    => 'Culture rente',
                'required' => false,
            ])
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($culture);
            $objectManager->flush();
            return $this->redirect($request->getUri());
        }

        $cultures = $cultureRepository->findAll();

        return $this->render('culture/index.html.twig', [
            'cultures' => $cultures,
            'culture_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/culture/update/{id}", name="update_culture")
     */
    public function update(
        HttpFoundationRequest $request,
        ObjectManager $objectManager,
        CultureRepository $cultureRepository,
        Culture $culture
    ) {

        $form = $this->createFormBuilder($culture)
            ->add('nom')
            ->add('rente', CheckboxType::class, [
                'label'    => 'Culture rente',
                'required' => false,
            ])
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $objectManager->persist($culture);
            $objectManager->flush();
            return $this->redirectToRoute('culture');
        }

        $cultures = $cultureRepository->findAll();

        return $this->render('culture/index.html.twig', [
            'cultures' => $cultures,
            'culture_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/culture/delete/{id}", name="delete_culture")
     */
    public function delete(Culture $culture, ObjectManager $objectManager)
    {
        $objectManager->remove($culture);
        $objectManager->flush();
        return $this->redirectToRoute('culture');
    }
}
