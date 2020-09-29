<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\AgriculteurRepository;
use App\Repository\ParcelleRepository;
use App\Repository\SystemeCulturalRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(
        AgriculteurRepository $agriculteurRepository,
        ParcelleRepository $parcelleRepository,
        SystemeCulturalRepository $systemeCulturalRepository
    ) {
        $hf = $agriculteurRepository->nbrGenre();

        $nbrFemme = -1;
        $nbrHomme = -1;
        
        if ($hf[0]["genre"] == 0) {
            $nbrFemme = $hf[0]["nbr"];
            $nbrHomme = $hf[1]["nbr"];
        } else {
            $nbrFemme = $hf[1]["nbr"];
            $nbrHomme = $hf[0]["nbr"];
        }
        
        $nbrAgriculteur = $nbrFemme + $nbrHomme;
        $nbrParcelle = sizeof($parcelleRepository->findAll());
        $reboisement = $systemeCulturalRepository->nbrSemence('foresterie')[0];

        // SCA
        $sca = $agriculteurRepository->getSCA();
        $totalSCA = $sca['acceptable']+$sca['limite']+$sca['pauvre'];
        $totalSCA > 0 ? $sca['total'] = $totalSCA : $sca['total'] = 1;

        // Accès eau potable
        $accesEauPotable = $agriculteurRepository->getAccesEau();

        // Hygiène
        $toilettes = $agriculteurRepository->getStat('toilette');
        $toilette = '[';
        foreach ($toilettes as $t) {
            $toilette = $toilette.$t["nbr"].',';
        }
        $toilette = substr($toilette, 0, -1).']';

        $douches = $agriculteurRepository->getStat('douche');
        $douche = '[';
        foreach ($douches as $t) {
            $douche = $douche.$t["nbr"].',';
        }
        $douche = substr($douche, 0, -1).']';

        $assainissements = $agriculteurRepository->getStat('assainissement');
        $assainissement = '[';
        foreach ($assainissements as $t) {
            $assainissement = $assainissement.$t["nbr"].',';
        }
        $assainissement = substr($assainissement, 0, -1).']';

        // Education
        $educations = $agriculteurRepository->getStat('acces_education');
        $education = '[';
        foreach ($educations as $t) {
            $education = $education.$t["nbr"].',';
        }
        $education = substr($education, 0, -1).']';

        // Sante
        $santes = $agriculteurRepository->getStatSante();
        $sante = '[';
        foreach ($santes as $t) {
            $sante = $sante.$t["nbr"].',';
        }
        $sante = substr($sante, 0, -1).']';
        
        return $this->render('home.html.twig', [
            'femmes' => $nbrFemme,
            'hommes' => $nbrHomme,
            'sca' => $sca,
            'agriculteurs' => $nbrAgriculteur,
            'parcelles' => $nbrParcelle,
            'reboisement' => $reboisement,
            'toilette' => $toilette,
            'douche' => $douche,
            'assainissement' => $assainissement,
            'education' => $education,
            'sante' => $sante,
            'accesEauPotable' => $accesEauPotable,
        ]);
    }

    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(
        Request $request,
        ObjectManager $objectManager,
        UserPasswordEncoderInterface $userPasswordEncoderInterface
    ) {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->get('role')) {
                $user->setRoles($request->request->get('role'));
            }

            $hash = $userPasswordEncoderInterface->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);

            $objectManager->persist($user);
            $objectManager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render('security/registration.html.twig', [
            'base_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login()
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
    }
}
