<?php

namespace App\Entity;

use App\Repository\CultureMereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CultureMereRepository::class)
 */
class CultureMere
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $nouvellePlantation;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $surfaceCultive;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moPreparationSol;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moInstallationCulture;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moEntretien1;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moEntretien2;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moEntretien3;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moRecolte;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moExtPreparationSol;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moExtInstallationCulture;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moExtEntretien1;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moExtEntretien2;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moExtEntretien3;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $moExtRecolte;

    /**
     * @ORM\ManyToOne(targetEntity=CycleAgricole::class, inversedBy="cultureMeres")
     */
    private $cycleAgricole;

    /**
     * @ORM\ManyToOne(targetEntity=PrecedentCultural::class, inversedBy="cultureMeres")
     */
    private $precedentCultural;

    /**
     * @ORM\ManyToOne(targetEntity=SystemeCultural::class, inversedBy="cultureMeres")
     */
    private $systemeCultural;

    /**
     * @ORM\ManyToOne(targetEntity=ItineraireCultural::class, inversedBy="cultureMeres")
     */
    private $itineraireCultural;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datePlantation;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $agePlantation;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $qteFumureOrganique;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $qteInsecticide;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $misEnCloture;

    /**
     * @ORM\ManyToOne(targetEntity=EtatPc::class, inversedBy="cultureMeres")
     */
    private $etatPc;

    /**
     * @ORM\ManyToOne(targetEntity=EtatMulch::class, inversedBy="cultureMeres")
     */
    private $etatMulch;

    /**
     * @ORM\ManyToOne(targetEntity=PreparationParcelle::class, inversedBy="cultureMeres")
     */
    private $preparationParcelle;

    /**
     * @ORM\ManyToOne(targetEntity=ControlleBiomas::class, inversedBy="cultureMeres")
     */
    private $controlleBiomas;

    /**
     * @ORM\ManyToOne(targetEntity=ModeInstallation::class, inversedBy="cultureMeres")
     */
    private $modeInstallation;

    /**
     * @ORM\ManyToOne(targetEntity=TypePepiniere::class, inversedBy="cultureMeres")
     */
    private $typePepiniere;

    /**
     * @ORM\ManyToOne(targetEntity=ModeRepiquage::class, inversedBy="cultureMeres")
     */
    private $modeRepiquage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrSarclage;

    /**
     * @ORM\ManyToOne(targetEntity=TypeSarclage::class, inversedBy="cultureMeres")
     */
    private $typeSarclage;

    /**
     * @ORM\ManyToOne(targetEntity=DegatCyclonique::class, inversedBy="cultureMeres")
     */
    private $degatCyclonique;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $utilisationPcFourage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $misEnCulture;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $UtilisationPcPaillageSurAutreParcelle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $utilisationPcCompost;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $basketCompost;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rente;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ecobuage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sondageRendement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pmg;

    /**
     * @ORM\ManyToOne(targetEntity=SondageQualitatif::class, inversedBy="cultureMeres")
     */
    private $sondageQualitatif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remarqueAVSF;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $anneeAgricoleAVSF;

    /**
     * @ORM\OneToMany(targetEntity=CultureFille::class, mappedBy="cultureMere")
     */
    private $cultureFilles;

    /**
     * @ORM\ManyToOne(targetEntity=Parcelle::class, inversedBy="cultureMeres")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $parcelle;

    /**
     * @ORM\OneToMany(targetEntity=NbrFumureCultureM::class, mappedBy="culture")
     */
    private $nbrFumureCultureMs;

    /**
     * @ORM\OneToMany(targetEntity=NbrInsecticideCultureM::class, mappedBy="culture")
     */
    private $nbrInsecticideCultureMs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tarifMO;

    public function __construct()
    {
        $this->cultureFilles = new ArrayCollection();
        $this->nbrFumureCultureMs = new ArrayCollection();
        $this->nbrInsecticideCultureMs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNouvellePlantation(): ?bool
    {
        return $this->nouvellePlantation;
    }

    public function setNouvellePlantation(?bool $nouvellePlantation): self
    {
        $this->nouvellePlantation = $nouvellePlantation;

        return $this;
    }

    public function getSurfaceCultive(): ?string
    {
        return $this->surfaceCultive;
    }

    public function setSurfaceCultive(?string $surfaceCultive): self
    {
        $this->surfaceCultive = $surfaceCultive;

        return $this;
    }

    public function getMoPreparationSol(): ?string
    {
        return $this->moPreparationSol;
    }

    public function setMoPreparationSol(?string $moPreparationSol): self
    {
        $this->moPreparationSol = $moPreparationSol;

        return $this;
    }

    public function getMoInstallationCulture(): ?string
    {
        return $this->moInstallationCulture;
    }

    public function setMoInstallationCulture(?string $moInstallationCulture): self
    {
        $this->moInstallationCulture = $moInstallationCulture;

        return $this;
    }

    public function getMoEntretien1(): ?string
    {
        return $this->moEntretien1;
    }

    public function setMoEntretien1(?string $moEntretien1): self
    {
        $this->moEntretien1 = $moEntretien1;

        return $this;
    }

    public function getMoEntretien2(): ?string
    {
        return $this->moEntretien2;
    }

    public function setMoEntretien2(?string $moEntretien2): self
    {
        $this->moEntretien2 = $moEntretien2;

        return $this;
    }

    public function getMoEntretien3(): ?string
    {
        return $this->moEntretien3;
    }

    public function setMoEntretien3(?string $moEntretien3): self
    {
        $this->moEntretien3 = $moEntretien3;

        return $this;
    }

    public function getMoRecolte(): ?string
    {
        return $this->moRecolte;
    }

    public function setMoRecolte(?string $moRecolte): self
    {
        $this->moRecolte = $moRecolte;

        return $this;
    }

    public function getMoExtPreparationSol(): ?string
    {
        return $this->moExtPreparationSol;
    }

    public function setMoExtPreparationSol(?string $moExtPreparationSol): self
    {
        $this->moExtPreparationSol = $moExtPreparationSol;

        return $this;
    }

    public function getMoExtInstallationCulture(): ?string
    {
        return $this->moExtInstallationCulture;
    }

    public function setMoExtInstallationCulture(?string $moExtInstallationCulture): self
    {
        $this->moExtInstallationCulture = $moExtInstallationCulture;

        return $this;
    }

    public function getMoExtEntretien1(): ?string
    {
        return $this->moExtEntretien1;
    }

    public function setMoExtEntretien1(?string $moExtEntretien1): self
    {
        $this->moExtEntretien1 = $moExtEntretien1;

        return $this;
    }

    public function getMoExtEntretien2(): ?string
    {
        return $this->moExtEntretien2;
    }

    public function setMoExtEntretien2(?string $moExtEntretien2): self
    {
        $this->moExtEntretien2 = $moExtEntretien2;

        return $this;
    }

    public function getMoExtEntretien3(): ?string
    {
        return $this->moExtEntretien3;
    }

    public function setMoExtEntretien3(?string $moExtEntretien3): self
    {
        $this->moExtEntretien3 = $moExtEntretien3;

        return $this;
    }

    public function getMoExtRecolte(): ?string
    {
        return $this->moExtRecolte;
    }

    public function setMoExtRecolte(?string $moExtRecolte): self
    {
        $this->moExtRecolte = $moExtRecolte;

        return $this;
    }

    public function getCycleAgricole(): ?CycleAgricole
    {
        return $this->cycleAgricole;
    }

    public function getCycleAgricoleString(): ?String
    {
        return $this->cycleAgricole ? $this->cycleAgricole->getNom() : null;
    }

    public function setCycleAgricole(?CycleAgricole $cycleAgricole): self
    {
        $this->cycleAgricole = $cycleAgricole;

        return $this;
    }

    public function getPrecedentCultural(): ?PrecedentCultural
    {
        return $this->precedentCultural;
    }

    public function getPrecedentCulturalString(): ?String
    {
        return $this->precedentCultural ? $this->precedentCultural->getNom() : null;
    }

    public function setPrecedentCultural(?PrecedentCultural $precedentCultural): self
    {
        $this->precedentCultural = $precedentCultural;

        return $this;
    }

    public function getSystemeCultural(): ?SystemeCultural
    {
        return $this->systemeCultural;
    }

    public function getSystemeCulturalString(): ?String
    {
        return $this->systemeCultural ? $this->systemeCultural->getNom() : null;
    }

    public function setSystemeCultural(?SystemeCultural $systemeCultural): self
    {
        $this->systemeCultural = $systemeCultural;

        return $this;
    }

    public function getItineraireCultural(): ?ItineraireCultural
    {
        return $this->itineraireCultural;
    }

    public function getItineraireCulturalString(): ?String
    {
        return $this->itineraireCultural ? $this->itineraireCultural->getNom() : null;
    }

    public function setItineraireCultural(?ItineraireCultural $itineraireCultural): self
    {
        $this->itineraireCultural = $itineraireCultural;

        return $this;
    }

    public function getDatePlantation(): ?\DateTimeInterface
    {
        return $this->datePlantation;
    }

    public function setDatePlantation(?\DateTimeInterface $datePlantation): self
    {
        $this->datePlantation = $datePlantation;

        return $this;
    }

    public function setDatePlantationString($datePlantation): self
    {
        if ($datePlantation != null) {
            $this->datePlantation = \DateTime::createFromFormat('Y-m-d H:i:s', $datePlantation);
        }

        return $this;
    }

    public function getAgePlantation(): ?int
    {
        return $this->agePlantation;
    }

    public function setAgePlantation(?int $agePlantation): self
    {
        $this->agePlantation = $agePlantation;

        return $this;
    }

    public function getQteFumureOrganique(): ?string
    {
        return $this->qteFumureOrganique;
    }

    public function setQteFumureOrganique(?string $qteFumureOrganique): self
    {
        $this->qteFumureOrganique = $qteFumureOrganique;

        return $this;
    }

    public function getQteInsecticide(): ?string
    {
        return $this->qteInsecticide;
    }

    public function setQteInsecticide(?string $qteInsecticide): self
    {
        $this->qteInsecticide = $qteInsecticide;

        return $this;
    }

    public function getMisEnCloture(): ?bool
    {
        return $this->misEnCloture;
    }

    public function setMisEnCloture(?bool $misEnCloture): self
    {
        $this->misEnCloture = $misEnCloture;

        return $this;
    }

    public function getEtatPc(): ?EtatPc
    {
        return $this->etatPc;
    }

    public function setEtatPc(?EtatPc $etatPc): self
    {
        $this->etatPc = $etatPc;

        return $this;
    }

    public function getEtatMulch(): ?EtatMulch
    {
        return $this->etatMulch;
    }

    public function setEtatMulch(?EtatMulch $etatMulch): self
    {
        $this->etatMulch = $etatMulch;

        return $this;
    }

    public function getPreparationParcelle(): ?PreparationParcelle
    {
        return $this->preparationParcelle;
    }

    public function setPreparationParcelle(?PreparationParcelle $preparationParcelle): self
    {
        $this->preparationParcelle = $preparationParcelle;

        return $this;
    }

    public function getControlleBiomas(): ?ControlleBiomas
    {
        return $this->controlleBiomas;
    }

    public function setControlleBiomas(?ControlleBiomas $controlleBiomas): self
    {
        $this->controlleBiomas = $controlleBiomas;

        return $this;
    }

    public function getModeInstallation(): ?ModeInstallation
    {
        return $this->modeInstallation;
    }

    public function setModeInstallation(?ModeInstallation $modeInstallation): self
    {
        $this->modeInstallation = $modeInstallation;

        return $this;
    }

    public function getTypePepiniere(): ?TypePepiniere
    {
        return $this->typePepiniere;
    }

    public function setTypePepiniere(?TypePepiniere $typePepiniere): self
    {
        $this->typePepiniere = $typePepiniere;

        return $this;
    }

    public function getModeRepiquage(): ?ModeRepiquage
    {
        return $this->modeRepiquage;
    }

    public function setModeRepiquage(?ModeRepiquage $modeRepiquage): self
    {
        $this->modeRepiquage = $modeRepiquage;

        return $this;
    }

    public function getNbrSarclage(): ?int
    {
        return $this->nbrSarclage;
    }

    public function setNbrSarclage(?int $nbrSarclage): self
    {
        $this->nbrSarclage = $nbrSarclage;

        return $this;
    }

    public function getTypeSarclage(): ?TypeSarclage
    {
        return $this->typeSarclage;
    }

    public function setTypeSarclage(?TypeSarclage $typeSarclage): self
    {
        $this->typeSarclage = $typeSarclage;

        return $this;
    }

    public function getDegatCyclonique(): ?DegatCyclonique
    {
        return $this->degatCyclonique;
    }

    public function setDegatCyclonique(?DegatCyclonique $degatCyclonique): self
    {
        $this->degatCyclonique = $degatCyclonique;

        return $this;
    }

    public function getUtilisationPcFourage(): ?bool
    {
        return $this->utilisationPcFourage;
    }

    public function setUtilisationPcFourage(?bool $utilisationPcFourage): self
    {
        $this->utilisationPcFourage = $utilisationPcFourage;

        return $this;
    }

    public function getMisEnCulture(): ?bool
    {
        return $this->misEnCulture;
    }

    public function setMisEnCulture(?bool $misEnCulture): self
    {
        $this->misEnCulture = $misEnCulture;

        return $this;
    }

    public function getUtilisationPcPaillageSurAutreParcelle(): ?bool
    {
        return $this->UtilisationPcPaillageSurAutreParcelle;
    }

    public function setUtilisationPcPaillageSurAutreParcelle(?bool $UtilisationPcPaillageSurAutreParcelle): self
    {
        $this->UtilisationPcPaillageSurAutreParcelle = $UtilisationPcPaillageSurAutreParcelle;

        return $this;
    }

    public function getUtilisationPcCompost(): ?bool
    {
        return $this->utilisationPcCompost;
    }

    public function setUtilisationPcCompost(?bool $utilisationPcCompost): self
    {
        $this->utilisationPcCompost = $utilisationPcCompost;

        return $this;
    }

    public function getBasketCompost(): ?bool
    {
        return $this->basketCompost;
    }

    public function setBasketCompost(?bool $basketCompost): self
    {
        $this->basketCompost = $basketCompost;

        return $this;
    }

    public function getRente(): ?bool
    {
        return $this->rente;
    }

    public function setRente(?bool $rente): self
    {
        $this->rente = $rente;

        return $this;
    }

    public function getEcobuage(): ?bool
    {
        return $this->ecobuage;
    }

    public function setEcobuage(?bool $ecobuage): self
    {
        $this->ecobuage = $ecobuage;

        return $this;
    }

    public function getSondageRendement(): ?bool
    {
        return $this->sondageRendement;
    }

    public function setSondageRendement(?bool $sondageRendement): self
    {
        $this->sondageRendement = $sondageRendement;

        return $this;
    }

    public function getPmg(): ?int
    {
        return $this->pmg;
    }

    public function setPmg(?int $pmg): self
    {
        $this->pmg = $pmg;

        return $this;
    }

    public function getSondageQualitatif(): ?SondageQualitatif
    {
        return $this->sondageQualitatif;
    }

    public function setSondageQualitatif(?SondageQualitatif $sondageQualitatif): self
    {
        $this->sondageQualitatif = $sondageQualitatif;

        return $this;
    }

    public function getRemarqueAVSF(): ?string
    {
        return $this->remarqueAVSF;
    }

    public function setRemarqueAVSF(?string $remarqueAVSF): self
    {
        $this->remarqueAVSF = $remarqueAVSF;

        return $this;
    }

    public function getAnneeAgricoleAVSF(): ?string
    {
        return $this->anneeAgricoleAVSF;
    }

    public function setAnneeAgricoleAVSF(?string $anneeAgricoleAVSF): self
    {
        $this->anneeAgricoleAVSF = $anneeAgricoleAVSF;

        return $this;
    }

    /**
     * @return Collection|CultureFille[]
     */
    public function getCultureFilles(): Collection
    {
        return $this->cultureFilles;
    }

    public function addCultureFille(CultureFille $cultureFille): self
    {
        if (!$this->cultureFilles->contains($cultureFille)) {
            $this->cultureFilles[] = $cultureFille;
            $cultureFille->setCultureMere($this);
        }

        return $this;
    }

    public function removeCultureFille(CultureFille $cultureFille): self
    {
        if ($this->cultureFilles->contains($cultureFille)) {
            $this->cultureFilles->removeElement($cultureFille);
            // set the owning side to null (unless already changed)
            if ($cultureFille->getCultureMere() === $this) {
                $cultureFille->setCultureMere(null);
            }
        }

        return $this;
    }

    public function getParcelle(): ?Parcelle
    {
        return $this->parcelle;
    }

    public function getParcelleString(): ?String
    {
        return $this->parcelle ? $this->parcelle->getId() : null;
    }

    public function setParcelle(?Parcelle $parcelle): self
    {
        $this->parcelle = $parcelle;

        return $this;
    }

    /**
     * @return Collection|NbrFumureCultureM[]
     */
    public function getNbrFumureCultureMs(): Collection
    {
        return $this->nbrFumureCultureMs;
    }

    public function getNbrNPK()
    {
        if ($this->nbrFumureCultureMs != null) {
            foreach ($this->nbrFumureCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getFumure()->getNom(), 'NPK (kg/ha)')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }

    public function getNbrUree()
    {
        if ($this->nbrFumureCultureMs != null) {
            foreach ($this->nbrFumureCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getFumure()->getNom(), 'Uree (kg/ha)') ==0 || strcasecmp($nbrCultureA->getFumure()->getNom(), 'Urée (kg/ha)')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }

    public function getNbrAutreFumure()
    {
        if ($this->nbrFumureCultureMs != null) {
            foreach ($this->nbrFumureCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getFumure()->getNom(), 'Autre') == 0 || strcasecmp($nbrCultureA->getFumure()->getNom(), 'Autre fumure (kg/ha)')==0 || strcasecmp($nbrCultureA->getFumure()->getNom(), 'Autres fumures')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }

    public function addNbrFumureCultureM(NbrFumureCultureM $nbrFumureCultureM): self
    {
        if (!$this->nbrFumureCultureMs->contains($nbrFumureCultureM)) {
            $this->nbrFumureCultureMs[] = $nbrFumureCultureM;
            $nbrFumureCultureM->setCulture($this);
        }

        return $this;
    }

    public function removeNbrFumureCultureM(NbrFumureCultureM $nbrFumureCultureM): self
    {
        if ($this->nbrFumureCultureMs->contains($nbrFumureCultureM)) {
            $this->nbrFumureCultureMs->removeElement($nbrFumureCultureM);
            // set the owning side to null (unless already changed)
            if ($nbrFumureCultureM->getCulture() === $this) {
                $nbrFumureCultureM->setCulture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NbrInsecticideCultureM[]
     */
    public function getNbrInsecticideCultureMs(): Collection
    {
        return $this->nbrInsecticideCultureMs;
    }

    public function getNbrHerbicide()
    {
        if ($this->nbrInsecticideCultureMs != null) {
            foreach ($this->nbrInsecticideCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Herbicide poudre (kg/ha)')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }
    public function getNbrHerbicideL()
    {
        if ($this->nbrInsecticideCultureMs != null) {
            foreach ($this->nbrInsecticideCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Herbicide liquide (l/ha)')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }
    public function getNbrFongicide()
    {
        if ($this->nbrInsecticideCultureMs != null) {
            foreach ($this->nbrInsecticideCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Fongicide poudre (kg/ha)')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }
    public function getNbrFongicideL()
    {
        if ($this->nbrInsecticideCultureMs != null) {
            foreach ($this->nbrInsecticideCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Fongicide liquide (l/ha)')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }

    public function getNbrAutrePesticide()
    {
        if ($this->nbrInsecticideCultureMs != null) {
            foreach ($this->nbrInsecticideCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Autre pesticide poudre (kg/ha)')==0 || strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Autre pesticide')==0 || strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Autres pesticides')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }
    public function getNbrAutrePesticideL()
    {
        if ($this->nbrInsecticideCultureMs != null) {
            foreach ($this->nbrInsecticideCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Autre pesticide liquide (l/ha)')==0 || strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Autre pesticide')==0 || strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Autres pesticides')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }
    public function getNbrInsecticideL()
    {
        if ($this->nbrInsecticideCultureMs != null) {
            foreach ($this->nbrInsecticideCultureMs as $nbrCultureA) {
                if (strcasecmp($nbrCultureA->getInsecticide()->getNom(), 'Insecticides liquide (l/ha)')==0) {
                    return $nbrCultureA->getNbr();
                }
            }
        }
        return 0;
    }

    public function addNbrInsecticideCultureM(NbrInsecticideCultureM $nbrInsecticideCultureM): self
    {
        if (!$this->nbrInsecticideCultureMs->contains($nbrInsecticideCultureM)) {
            $this->nbrInsecticideCultureMs[] = $nbrInsecticideCultureM;
            $nbrInsecticideCultureM->setCulture($this);
        }

        return $this;
    }

    public function removeNbrInsecticideCultureM(NbrInsecticideCultureM $nbrInsecticideCultureM): self
    {
        if ($this->nbrInsecticideCultureMs->contains($nbrInsecticideCultureM)) {
            $this->nbrInsecticideCultureMs->removeElement($nbrInsecticideCultureM);
            // set the owning side to null (unless already changed)
            if ($nbrInsecticideCultureM->getCulture() === $this) {
                $nbrInsecticideCultureM->setCulture(null);
            }
        }

        return $this;
    }

    public function getTarifMO(): ?int
    {
        return $this->tarifMO;
    }

    public function setTarifMO(?int $tarifMO): self
    {
        $this->tarifMO = $tarifMO;

        return $this;
    }

    public function complete($table): self
    {
        // $this->setId();
        // $this->setParcelleString();1
        $this->setNouvellePlantation($table[2]);
        // $this->setCycleAgricoleString();3
        $this->setSurfaceCultive(floatval($table[4]));
        // $this->setPrecedentCulturalString();5
        // $this->setSystemeCulturalString();6
        // $this->setItineraireCulturalString();7
        $this->setMoPreparationSol(floatval($table[8]));
        $this->setMoInstallationCulture(floatval($table[9]));
        $this->setMoEntretien1(floatval($table[10]));
        $this->setMoEntretien2(floatval($table[11]));
        $this->setMoEntretien3(floatval($table[12]));
        $this->setMoRecolte(floatval($table[13]));
        $this->setMoExtPreparationSol(floatval($table[14]));
        $this->setMoExtInstallationCulture(floatval($table[15]));
        $this->setMoExtEntretien1(floatval($table[16]));
        $this->setMoExtEntretien2(floatval($table[17]));
        $this->setMoExtEntretien3(floatval($table[18]));
        $this->setMoExtRecolte(floatval($table[19]));
        $this->setTarifMO(floatval($table[20]));
        $this->setDatePlantationString($table[21]);
        $this->setAgePlantation(intval($table[22]));
        $this->setQteFumureOrganique(floatval($table[39]));
        $this->setQteInsecticide(floatval($table[43]));
        $this->setMisEnCloture($table[51]);

        return $this;
    }
}
