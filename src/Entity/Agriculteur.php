<?php

namespace App\Entity;

use App\Repository\AgriculteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgriculteurRepository::class)
 */
class Agriculteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="smallint")
     */
    private $genre;

    /**
     * @ORM\Column(type="smallint")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $statutFamille;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $district;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $surfaceTotaleExploitee;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $surfaceTotaleRiziere;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $surfaceParcelleLouee;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $surfaceParcelleEnLocation;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbrMenage;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbrActif;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbrMoisAutosuffisanceRiz;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accesAuRiziere;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $equipementAgricole;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pratiqueActiviteAgricole;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pratiqueElevageRente;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pratiqueActiviteNonAgricole;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pratiquePeche;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $autreProgramme;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nbrMoisSoudure;

    /**
     * @ORM\OneToMany(targetEntity=NbrElevageAgriculteur::class, mappedBy="agriculteur")
     */
    private $nbrElevageAgriculteurs;

    /**
     * @ORM\ManyToOne(targetEntity=Typologie::class, inversedBy="agriculteurs")
     */
    private $typologie;

    /**
     * @ORM\ManyToOne(targetEntity=Bvpi::class, inversedBy="agriculteurs")
     */
    private $bvpi;

    /**
     * @ORM\ManyToOne(targetEntity=ZoneTechnicien::class, inversedBy="agriculteurs")
     */
    private $zoneTechnicien;

    /**
     * @ORM\ManyToOne(targetEntity=Op::class, inversedBy="agriculteurs")
     */
    private $op;

    /**
     * @ORM\ManyToOne(targetEntity=Ce::class, inversedBy="agriculteurs")
     */
    private $ce;

    /**
     * @ORM\ManyToOne(targetEntity=Elevage::class, inversedBy="agriculteurs")
     */
    private $elevage;

    /**
     * @ORM\ManyToOne(targetEntity=Culture::class, inversedBy="agriculteurs")
     */
    private $culture;

    /**
     * @ORM\OneToMany(targetEntity=NbrCultureAgriculteur::class, mappedBy="agriculteur")
     */
    private $nbrCultureAgriculteur;

    /**
     * @ORM\OneToMany(targetEntity=NbrEquipementAgricoleAgriculteur::class, mappedBy="agriculteur")
     */
    private $nbrEquipementAgricoleAgriculteur;

    /**
     * @ORM\OneToMany(targetEntity=Parcelle::class, mappedBy="agriculteur")
     */
    private $parcelles;

    /**
     * @ORM\ManyToOne(targetEntity=Village::class, inversedBy="agriculteurs")
     */
    private $village;

    /**
     * @ORM\ManyToOne(targetEntity=Terroir::class, inversedBy="agriculteurs")
     */
    private $terroir;

    /**
     * @ORM\ManyToOne(targetEntity=SousRegion::class, inversedBy="agriculteurs")
     */
    private $sousRegion;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="agriculteurs")
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity=Commune::class, inversedBy="agriculteurs")
     */
    private $commune;

    /**
     * @ORM\ManyToOne(targetEntity=AncienneteAgriculteur::class, inversedBy="agriculteurs")
     */
    private $anciennete;

    /**
     * @ORM\ManyToOne(targetEntity=TypeElevage::class, inversedBy="agriculteurs")
     */
    private $typeElevage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $opBoolean;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $calendrier;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $outilAmeliore;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $differenceBesoinsAlimentaire;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $connaissanceDifferenceBesoinsAlimentaire;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $regimeAlimentaireVariee;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $assuranceProduitNecessaireAlimentation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enregistrementMouvementArgent;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $enregistrementMouvementArgentWhy;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $epargne;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $connaissanceDemandeCoursProduitAgricole;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $connaissanceDemandeCoursProduitAgricoleWhy;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ameliorerQualiteProduit;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $ameliorerQualiteProduitWhy;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $groupement;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $avantageRegroupement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accesEauPotable;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    // Aucun, haut, moyen, bas
    private $toilette;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    // Aucun, haut, moyen, bas
    private $douche;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    // Aucun, haut, moyen, bas
    private $assainissement;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    // base, secondaire, universitaire
    private $accesEducation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $medecinTraditionnel;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $medecinConventionnel;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $latitude;

    public function __construct()
    {
        $this->nbrElevageAgriculteurs = new ArrayCollection();
        $this->nbrCultureAgriculteur = new ArrayCollection();
        $this->nbrEquipementAgricoleAgriculteur = new ArrayCollection();
        $this->parcelles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getStatutFamille(): ?string
    {
        return $this->statutFamille;
    }

    public function setStatutFamille(string $statutFamille): self
    {
        $this->statutFamille = $statutFamille;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getSurfaceTotaleExploitee(): ?string
    {
        return $this->surfaceTotaleExploitee;
    }

    public function setSurfaceTotaleExploitee(?string $surfaceTotaleExploitee): self
    {
        $this->surfaceTotaleExploitee = $surfaceTotaleExploitee;

        return $this;
    }

    public function getSurfaceTotaleRiziere(): ?string
    {
        return $this->surfaceTotaleRiziere;
    }

    public function setSurfaceTotaleRiziere(?string $surfaceTotaleRiziere): self
    {
        $this->surfaceTotaleRiziere = $surfaceTotaleRiziere;

        return $this;
    }

    public function getSurfaceParcelleLouee(): ?string
    {
        return $this->surfaceParcelleLouee;
    }

    public function setSurfaceParcelleLouee(?string $surfaceParcelleLouee): self
    {
        $this->surfaceParcelleLouee = $surfaceParcelleLouee;

        return $this;
    }

    public function getSurfaceParcelleEnLocation(): ?string
    {
        return $this->surfaceParcelleEnLocation;
    }

    public function setSurfaceParcelleEnLocation(?string $surfaceParcelleEnLocation): self
    {
        $this->surfaceParcelleEnLocation = $surfaceParcelleEnLocation;

        return $this;
    }

    public function getNbrMenage(): ?int
    {
        return $this->nbrMenage;
    }

    public function setNbrMenage(?int $nbrMenage): self
    {
        $this->nbrMenage = $nbrMenage;

        return $this;
    }

    public function getNbrActif(): ?int
    {
        return $this->nbrActif;
    }

    public function setNbrActif(?int $nbrActif): self
    {
        $this->nbrActif = $nbrActif;

        return $this;
    }

    public function getNbrMoisAutosuffisanceRiz(): ?int
    {
        return $this->nbrMoisAutosuffisanceRiz;
    }

    public function setNbrMoisAutosuffisanceRiz(?int $nbrMoisAutosuffisanceRiz): self
    {
        $this->nbrMoisAutosuffisanceRiz = $nbrMoisAutosuffisanceRiz;

        return $this;
    }

    public function getAccesAuRiziere(): ?bool
    {
        return $this->accesAuRiziere;
    }

    public function setAccesAuRiziere(?bool $accesAuRiziere): self
    {
        $this->accesAuRiziere = $accesAuRiziere;

        return $this;
    }

    public function getEquipementAgricole(): ?bool
    {
        return $this->equipementAgricole;
    }

    public function setEquipementAgricole(?bool $equipementAgricole): self
    {
        $this->equipementAgricole = $equipementAgricole;

        return $this;
    }

    public function getPratiqueActiviteAgricole(): ?bool
    {
        return $this->pratiqueActiviteAgricole;
    }

    public function setPratiqueActiviteAgricole(?bool $pratiqueActiviteAgricole): self
    {
        $this->pratiqueActiviteAgricole = $pratiqueActiviteAgricole;

        return $this;
    }

    public function getPratiqueElevageRente(): ?bool
    {
        return $this->pratiqueElevageRente;
    }

    public function setPratiqueElevageRente(?bool $pratiqueElevageRente): self
    {
        $this->pratiqueElevageRente = $pratiqueElevageRente;

        return $this;
    }

    public function getPratiqueActiviteNonAgricole(): ?bool
    {
        return $this->pratiqueActiviteNonAgricole;
    }

    public function setPratiqueActiviteNonAgricole(?bool $pratiqueActiviteNonAgricole): self
    {
        $this->pratiqueActiviteNonAgricole = $pratiqueActiviteNonAgricole;

        return $this;
    }

    public function getPratiquePeche(): ?bool
    {
        return $this->pratiquePeche;
    }

    public function setPratiquePeche(?bool $pratiquePeche): self
    {
        $this->pratiquePeche = $pratiquePeche;

        return $this;
    }

    public function getAutreProgramme(): ?bool
    {
        return $this->autreProgramme;
    }

    public function setAutreProgramme(?bool $autreProgramme): self
    {
        $this->autreProgramme = $autreProgramme;

        return $this;
    }

    public function getNbrMoisSoudure(): ?int
    {
        return $this->nbrMoisSoudure;
    }

    public function setNbrMoisSoudure(?int $nbrMoisSoudure): self
    {
        $this->nbrMoisSoudure = $nbrMoisSoudure;

        return $this;
    }

    /**
     * @return Collection|NbrElevageAgriculteur[]
     */
    public function getNbrElevageAgriculteurs(): Collection
    {
        return $this->nbrElevageAgriculteurs;
    }

    public function addNbrElevageAgriculteur(NbrElevageAgriculteur $nbrElevageAgriculteur): self
    {
        if (!$this->nbrElevageAgriculteurs->contains($nbrElevageAgriculteur)) {
            $this->nbrElevageAgriculteurs[] = $nbrElevageAgriculteur;
            $nbrElevageAgriculteur->setAgriculteur($this);
        }

        return $this;
    }

    public function removeNbrElevageAgriculteur(NbrElevageAgriculteur $nbrElevageAgriculteur): self
    {
        if ($this->nbrElevageAgriculteurs->contains($nbrElevageAgriculteur)) {
            $this->nbrElevageAgriculteurs->removeElement($nbrElevageAgriculteur);
            // set the owning side to null (unless already changed)
            if ($nbrElevageAgriculteur->getAgriculteur() === $this) {
                $nbrElevageAgriculteur->setAgriculteur(null);
            }
        }

        return $this;
    }

    public function getTypologie(): ?Typologie
    {
        return $this->typologie;
    }

    public function setTypologie(?Typologie $typologie): self
    {
        $this->typologie = $typologie;

        return $this;
    }

    public function getBvpi(): ?Bvpi
    {
        return $this->bvpi;
    }

    public function setBvpi(?Bvpi $bvpi): self
    {
        $this->bvpi = $bvpi;

        return $this;
    }

    public function getZoneTechnicien(): ?ZoneTechnicien
    {
        return $this->zoneTechnicien;
    }

    public function setZoneTechnicien(?ZoneTechnicien $zoneTechnicien): self
    {
        $this->zoneTechnicien = $zoneTechnicien;

        return $this;
    }

    public function getOp(): ?Op
    {
        return $this->op;
    }

    public function setOp(?Op $op): self
    {
        $this->op = $op;

        return $this;
    }

    public function getCe(): ?Ce
    {
        return $this->ce;
    }

    public function setCe(?Ce $ce): self
    {
        $this->ce = $ce;

        return $this;
    }

    public function getElevage(): ?Elevage
    {
        return $this->elevage;
    }

    public function setElevage(?Elevage $elevage): self
    {
        $this->elevage = $elevage;

        return $this;
    }

    public function getCulture(): ?Culture
    {
        return $this->culture;
    }

    public function setCulture(?Culture $culture): self
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * @return Collection|NbrCultureAgriculteur[]
     */
    public function getNbrCultureAgriculteur(): Collection
    {
        return $this->nbrCultureAgriculteur;
    }

    public function addNbrCultureAgriculteur(NbrCultureAgriculteur $nbrCultureAgriculteur): self
    {
        if (!$this->nbrCultureAgriculteur->contains($nbrCultureAgriculteur)) {
            $this->nbrCultureAgriculteur[] = $nbrCultureAgriculteur;
            $nbrCultureAgriculteur->setAgriculteur($this);
        }

        return $this;
    }

    public function removeNbrCultureAgriculteur(NbrCultureAgriculteur $nbrCultureAgriculteur): self
    {
        if ($this->nbrCultureAgriculteur->contains($nbrCultureAgriculteur)) {
            $this->nbrCultureAgriculteur->removeElement($nbrCultureAgriculteur);
            // set the owning side to null (unless already changed)
            if ($nbrCultureAgriculteur->getAgriculteur() === $this) {
                $nbrCultureAgriculteur->setAgriculteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NbrEquipementAgricoleAgriculteur[]
     */
    public function getNbrEquipementAgricoleAgriculteur(): Collection
    {
        return $this->nbrEquipementAgricoleAgriculteur;
    }

    public function addNbrEquipementAgricoleAgriculteur(NbrEquipementAgricoleAgriculteur $nbrEquipementAgricoleAgriculteur): self
    {
        if (!$this->nbrEquipementAgricoleAgriculteur->contains($nbrEquipementAgricoleAgriculteur)) {
            $this->nbrEquipementAgricoleAgriculteur[] = $nbrEquipementAgricoleAgriculteur;
            $nbrEquipementAgricoleAgriculteur->setAgriculteur($this);
        }

        return $this;
    }

    public function removeNbrEquipementAgricoleAgriculteur(NbrEquipementAgricoleAgriculteur $nbrEquipementAgricoleAgriculteur): self
    {
        if ($this->nbrEquipementAgricoleAgriculteur->contains($nbrEquipementAgricoleAgriculteur)) {
            $this->nbrEquipementAgricoleAgriculteur->removeElement($nbrEquipementAgricoleAgriculteur);
            // set the owning side to null (unless already changed)
            if ($nbrEquipementAgricoleAgriculteur->getAgriculteur() === $this) {
                $nbrEquipementAgricoleAgriculteur->setAgriculteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Parcelle[]
     */
    public function getParcelles(): Collection
    {
        return $this->parcelles;
    }

    public function addParcelle(Parcelle $parcelle): self
    {
        if (!$this->parcelles->contains($parcelle)) {
            $this->parcelles[] = $parcelle;
            $parcelle->setAgriculteur($this);
        }

        return $this;
    }

    public function removeParcelle(Parcelle $parcelle): self
    {
        if ($this->parcelles->contains($parcelle)) {
            $this->parcelles->removeElement($parcelle);
            // set the owning side to null (unless already changed)
            if ($parcelle->getAgriculteur() === $this) {
                $parcelle->setAgriculteur(null);
            }
        }

        return $this;
    }

    public function getVillage(): ?Village
    {
        return $this->village;
    }

    public function setVillage(?Village $village): self
    {
        $this->village = $village;

        return $this;
    }

    public function getTerroir(): ?Terroir
    {
        return $this->terroir;
    }

    public function setTerroir(?Terroir $terroir): self
    {
        $this->terroir = $terroir;

        return $this;
    }

    public function getSousRegion(): ?SousRegion
    {
        return $this->sousRegion;
    }

    public function setSousRegion(?SousRegion $sousRegion): self
    {
        $this->sousRegion = $sousRegion;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getAnciennete(): ?AncienneteAgriculteur
    {
        return $this->anciennete;
    }

    public function setAnciennete(?AncienneteAgriculteur $anciennete): self
    {
        $this->anciennete = $anciennete;

        return $this;
    }

    public function getTypeElevage(): ?TypeElevage
    {
        return $this->typeElevage;
    }

    public function setTypeElevage(?TypeElevage $typeElevage): self
    {
        $this->typeElevage = $typeElevage;

        return $this;
    }

    public function getOpBoolean(): ?bool
    {
        return $this->opBoolean;
    }

    public function setOpBoolean(bool $opBoolean): self
    {
        $this->opBoolean = $opBoolean;

        return $this;
    }

    public function getCalendrier(): ?int
    {
        return $this->calendrier;
    }

    public function setCalendrier(?int $calendrier): self
    {
        $this->calendrier = $calendrier;

        return $this;
    }

    public function getOutilAmeliore(): ?int
    {
        return $this->outilAmeliore;
    }

    public function setOutilAmeliore(?int $outilAmeliore): self
    {
        $this->outilAmeliore = $outilAmeliore;

        return $this;
    }

    public function getDifferenceBesoinsAlimentaire(): ?int
    {
        return $this->differenceBesoinsAlimentaire;
    }

    public function setDifferenceBesoinsAlimentaire(?int $differenceBesoinsAlimentaire): self
    {
        $this->differenceBesoinsAlimentaire = $differenceBesoinsAlimentaire;

        return $this;
    }

    public function getConnaissanceDifferenceBesoinsAlimentaire(): ?int
    {
        return $this->connaissanceDifferenceBesoinsAlimentaire;
    }

    public function setConnaissanceDifferenceBesoinsAlimentaire(?int $connaissanceDifferenceBesoinsAlimentaire): self
    {
        $this->connaissanceDifferenceBesoinsAlimentaire = $connaissanceDifferenceBesoinsAlimentaire;

        return $this;
    }

    public function getRegimeAlimentaireVariee(): ?int
    {
        return $this->regimeAlimentaireVariee;
    }

    public function setRegimeAlimentaireVariee(?int $regimeAlimentaireVariee): self
    {
        $this->regimeAlimentaireVariee = $regimeAlimentaireVariee;

        return $this;
    }

    public function getAssuranceProduitNecessaireAlimentation(): ?int
    {
        return $this->assuranceProduitNecessaireAlimentation;
    }

    public function setAssuranceProduitNecessaireAlimentation(?int $assuranceProduitNecessaireAlimentation): self
    {
        $this->assuranceProduitNecessaireAlimentation = $assuranceProduitNecessaireAlimentation;

        return $this;
    }

    public function getEnregistrementMouvementArgent(): ?int
    {
        return $this->enregistrementMouvementArgent;
    }

    public function setEnregistrementMouvementArgent(?int $enregistrementMouvementArgent): self
    {
        $this->enregistrementMouvementArgent = $enregistrementMouvementArgent;

        return $this;
    }

    public function getEnregistrementMouvementArgentWhy(): ?int
    {
        return $this->enregistrementMouvementArgentWhy;
    }

    public function setEnregistrementMouvementArgentWhy(?int $enregistrementMouvementArgentWhy): self
    {
        $this->enregistrementMouvementArgentWhy = $enregistrementMouvementArgentWhy;

        return $this;
    }

    public function getEpargne(): ?int
    {
        return $this->epargne;
    }

    public function setEpargne(?int $epargne): self
    {
        $this->epargne = $epargne;

        return $this;
    }

    public function getConnaissanceDemandeCoursProduitAgricole(): ?bool
    {
        return $this->connaissanceDemandeCoursProduitAgricole;
    }

    public function setConnaissanceDemandeCoursProduitAgricole(?bool $connaissanceDemandeCoursProduitAgricole): self
    {
        $this->connaissanceDemandeCoursProduitAgricole = $connaissanceDemandeCoursProduitAgricole;

        return $this;
    }

    public function getConnaissanceDemandeCoursProduitAgricoleWhy(): ?int
    {
        return $this->connaissanceDemandeCoursProduitAgricoleWhy;
    }

    public function setConnaissanceDemandeCoursProduitAgricoleWhy(?int $connaissanceDemandeCoursProduitAgricoleWhy): self
    {
        $this->connaissanceDemandeCoursProduitAgricoleWhy = $connaissanceDemandeCoursProduitAgricoleWhy;

        return $this;
    }

    public function getAmeliorerQualiteProduit(): ?bool
    {
        return $this->ameliorerQualiteProduit;
    }

    public function setAmeliorerQualiteProduit(?bool $ameliorerQualiteProduit): self
    {
        $this->ameliorerQualiteProduit = $ameliorerQualiteProduit;

        return $this;
    }

    public function getAmeliorerQualiteProduitWhy(): ?int
    {
        return $this->ameliorerQualiteProduitWhy;
    }

    public function setAmeliorerQualiteProduitWhy(?int $ameliorerQualiteProduitWhy): self
    {
        $this->ameliorerQualiteProduitWhy = $ameliorerQualiteProduitWhy;

        return $this;
    }

    public function getGroupement(): ?bool
    {
        return $this->groupement;
    }

    public function setGroupement(?bool $groupement): self
    {
        $this->groupement = $groupement;

        return $this;
    }

    public function getAvantageRegroupement(): ?int
    {
        return $this->avantageRegroupement;
    }

    public function setAvantageRegroupement(?int $avantageRegroupement): self
    {
        $this->avantageRegroupement = $avantageRegroupement;

        return $this;
    }

    public function getAccesEauPotable(): ?bool
    {
        return $this->accesEauPotable;
    }

    public function setAccesEauPotable(?bool $accesEauPotable): self
    {
        $this->accesEauPotable = $accesEauPotable;

        return $this;
    }

    public function getToilette(): ?int
    {
        return $this->toilette;
    }

    public function setToilette(?int $toilette): self
    {
        $this->toilette = $toilette;

        return $this;
    }

    public function getDouche(): ?int
    {
        return $this->douche;
    }

    public function setDouche(?int $douche): self
    {
        $this->douche = $douche;

        return $this;
    }

    public function getAssainissement(): ?int
    {
        return $this->assainissement;
    }

    public function setAssainissement(?int $assainissement): self
    {
        $this->assainissement = $assainissement;

        return $this;
    }

    public function getAccesEducation(): ?int
    {
        return $this->accesEducation;
    }

    public function setAccesEducation(?int $accesEducation): self
    {
        $this->accesEducation = $accesEducation;

        return $this;
    }

    public function getMedecinTraditionnel(): ?bool
    {
        return $this->medecinTraditionnel;
    }

    public function setMedecinTraditionnel(?bool $medecinTraditionnel): self
    {
        $this->medecinTraditionnel = $medecinTraditionnel;

        return $this;
    }

    public function getMedecinConventionnel(): ?bool
    {
        return $this->medecinConventionnel;
    }

    public function setMedecinConventionnel(?bool $medecinConventionnel): self
    {
        $this->medecinConventionnel = $medecinConventionnel;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }
}
