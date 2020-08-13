<?php

namespace App\Controller;

use App\Entity\CultureFille;
use App\Repository\AgePlantRepository;
use App\Repository\CultureFilleRepository;
use App\Repository\CultureMereRepository;
use App\Repository\CultureRepository;
use App\Repository\VarieteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;

class CultureFilleController extends AbstractController
{
    /**
     * @Route("/culture_filles", name="culture_fille")
     */
    public function index(HttpFoundationRequest $request, ObjectManager $objectManager, 
            CultureMereRepository $cultureMereRepository, VarieteRepository $varieteRepository,
            AgePlantRepository $agePlantRepository, CultureRepository $cultureRepository)
    {
        $cultureFille = new CultureFille();

        $varietes = $varieteRepository->findAll();
        $ages = $agePlantRepository->findAll();
        $plantes = $cultureRepository->findAll();

        $form = $this->createFormBuilder($cultureFille)
                     ->add('datePlantation')
                     ->add('QteSemence')
                     ->add('production')
                     ->add('rdt')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if($request->request->get('culture')) {
                $cultureFille->setCultureMere($cultureMereRepository
                        ->find($request->request->get('culture')));
            }
            if($request->request->get('variete')) {
                $cultureFille->setVariete($varieteRepository->find($request->request->get('variete')));
            }
            if($request->request->get('age')) {
                $cultureFille->setAgePlant($agePlantRepository->find($request->request->get('age')));
            }
            if($request->request->get('plante')) {
                $cultureFille->setPlante($cultureRepository->find($request->request->get('plante')));
            }

            $objectManager->persist($cultureFille);
            $objectManager->flush();

            return $this->redirect($request->getUri());
        }

        $cultureFilles = $cultureMereRepository->findAll();

        return $this->render('culture_fille/index.html.twig', [
            'plantes' => $plantes,
            'ages' => $ages,
            'varietes' => $varietes,
            'cultures' => $cultureFilles,
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/culture_fille/add/{idCultureMere}", name="ajout_culture_fille_from_mere")
     */
    public function add(HttpFoundationRequest $request, ObjectManager $objectManager, 
            AgePlantRepository $agePlantRepository, VarieteRepository $varieteRepository,
            CultureRepository $cultureRepository, $idCultureMere, 
            CultureMereRepository $cultureMereRepository)
    {
        $cultureFille = new CultureFille();

        $varietes = $varieteRepository->findAll();
        $ages = $agePlantRepository->findAll();
        $plantes = $cultureRepository->findAll();

        $form = $this->createFormBuilder($cultureFille)
                     ->add('datePlantation')
                     ->add('QteSemence')
                     ->add('production')
                     ->add('rdt')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $cultureFille->setCultureMere($cultureMereRepository->find($idCultureMere));

            if($request->request->get('variete')) {
                $cultureFille->setVariete($varieteRepository->find($request->request->get('variete')));
            }
            if($request->request->get('age')) {
                $cultureFille->setAgePlant($agePlantRepository->find($request->request->get('age')));
            }
            if($request->request->get('plante')) {
                $cultureFille->setPlante($cultureRepository->find($request->request->get('plante')));
            }

            $objectManager->persist($cultureFille);
            $objectManager->flush();

            return $this->redirectToRoute('detail_culture_mere', ['id'=>$idCultureMere]);
        }

        return $this->render('culture_fille/ajout_culture.html.twig', [
            'plantes' => $plantes,
            'ages' => $ages,
            'varietes' => $varietes,
            'base_form' => $form->createView(),
        ]);
    }

}
