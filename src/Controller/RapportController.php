<?php

namespace App\Controller;

use App\Repository\AgriculteurRepository;
use App\Repository\CommuneRepository;
use App\Repository\CultureMereRepository;
use App\Repository\CycleAgricoleRepository;
use App\Repository\ParcelleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RapportController extends AbstractController
{
    /**
     * @Route("/rapport_surface", name="rapport_surface")
     */
    public function surface(
        Request $request,
        CultureMereRepository $cultureMereRepository,
        CycleAgricoleRepository $cycleAgricoleRepository,
        CommuneRepository $communeRepository
    ) {

        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)->getForm();

        $compaigne = null;
        $cycleAgricole = null;
        $commune = null;

        $rapport = array();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // get research parameter
            if ($request->request->get('compaigne')) {
                $compaigne = $request->request->get('compaigne');
            }
            if ($request->request->get('cycleAgricole')) {
                $cycleAgricole = $request->request->get('cycleAgricole');
            }
            if ($request->request->get('commune')) {
                $commune = $request->request->get('commune');
            }
        }

        $compaignes = $cultureMereRepository->compaigne();
        $cycles = $cycleAgricoleRepository->findAll();
        $communes = $communeRepository->findAll();

        $rapport = $cultureMereRepository->rapportSurface($commune, $compaigne, $cycleAgricole);

        return $this->render('rapport/surface.html.twig', [
            'base_form' => $form->createView(),
            'communes' => $communes,
            'compaignes' => $compaignes,
            'cycles' => $cycles,
            'rapports' => $rapport,
            'selectedCompaigne' => $compaigne,
            'selectedCommune' => $commune,
            'selectedCycle' => $cycleAgricole,
        ]);
    }

    /**
     * @Route("/productivites", name="productivites")
     */
    public function productivite(
        Request $request, 
        CultureMereRepository $cultureMereRepository,
        CommuneRepository $communeRepository
    ) {

        $commune = null;
        $compaigne = null;

        if ($request->query->get('commune')) {
            $commune = $request->query->get('commune');
        }
        if ($request->query->get('compaigne')) {
            $compaigne = $request->query->get('compaigne');
        }

        $productivites = $cultureMereRepository->getProductivite($commune, $compaigne);
        $campaignes = $cultureMereRepository->compaigne();
        $communes = $communeRepository->findAll();

        return $this->render('rapport/productivite.html.twig', [
            'productivites' => $productivites,
            'compaignes' => $campaignes,
            'communes' => $communes,
            'selectedCompaigne' => $compaigne,
            'selectedCommune' => $commune,
        ]);
    }

    /**
     * @Route("/zone_erodibles", name="zone_erodibles")
     */
    public function index(ParcelleRepository $parcelleRepository)
    {
        $productivite = $parcelleRepository->zoneErodibles();

        return $this->render('rapport/productivite.html.twig', [
            'productivites' => $productivite,
        ]);
    }

    /**
     * @Route("/rapport_rendement", name="rapport_rendement")
     */
    public function rendement (
        Request $request,
        CultureMereRepository $cultureMereRepository,
        CycleAgricoleRepository $cycleAgricoleRepository,
        CommuneRepository $communeRepository
    ) {

        $compaigne = null;
        $cycleAgricole = null;
        $commune = null;

        $rapport = array();

        // get research parameter
        if ($request->query->get('compaigne')) {
            $compaigne = $request->query->get('compaigne');
        }
        if ($request->query->get('cycleAgricole')) {
            $cycleAgricole = $request->query->get('cycleAgricole');
        }
        if ($request->query->get('commune')) {
            $commune = $request->query->get('commune');
        }

        $compaignes = $cultureMereRepository->compaigne();
        $cycles = $cycleAgricoleRepository->findAll();
        $communes = $communeRepository->findAll();

        $rapport = $cultureMereRepository->rapportRendement($commune, $compaigne, $cycleAgricole);

        return $this->render('rapport/rendement.html.twig', [
            'communes' => $communes,
            'compaignes' => $compaignes,
            'cycles' => $cycles,
            'rapports' => $rapport,
            'selectedCompaigne' => $compaigne,
            'selectedCommune' => $commune,
            'selectedCycle' => $cycleAgricole,
        ]);
    }

    /**
     * @Route("/rapport_performance", name="rapport_performance")
     */
    public function performance (
        Request $request,
        CycleAgricoleRepository $cycleAgricoleRepository,
        AgriculteurRepository $agriculteurRepository
    ) {

        $cycleAgricole = null;
        $agriculteurId = null;

        $rapport = array();

        // get research parameter
        if ($request->query->get('cycleAgricole')) {
            $cycleAgricole = $request->query->get('cycleAgricole');
        }
        if ($request->query->get('agriculteur')) {
            $agriculteurId = $request->query->get('agriculteur');
        }

        $cycles = $cycleAgricoleRepository->findAll();
        $agriculteurs = $agriculteurRepository->findAll();

        $rapport = $agriculteurRepository->getPerformance($agriculteurId, $cycleAgricole);

        return $this->render('rapport/performance.html.twig', [
            'agriculteurs' => $agriculteurs,
            'cycles' => $cycles,
            'rapports' => $rapport,
            'selectedAgriculteur' => $agriculteurId,
            'selectedCycle' => $cycleAgricole,
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search (
        Request $request,
        AgriculteurRepository $agriculteurRepository,
        ParcelleRepository $parcelleRepository
    ) {

        $searchText = null;

        $rapport = array();

        // get research parameter
        if ($request->query->get('s')) {
            $searchText = $request->query->get('s');
        }

        $agriculteurs = $agriculteurRepository->globalSearch($searchText);
        $parcelles = $parcelleRepository->globalSearch($searchText);

        return $this->render('search.html.twig', [
            'agriculteurs' => $agriculteurs,
            'parcelles' => $parcelles,
            'searchText' => $searchText,
        ]);
    }

}
