<?php

namespace App\Entity;

use App\Repository\ParcelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcelleRepository::class)
 */
class Parcelle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Agriculteur::class, inversedBy="parcelles")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $agriculteur;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $surface;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="parcelles")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=TypeSol::class, inversedBy="parcelles")
     */
    private $TypeSol;

    /**
     * @ORM\ManyToOne(targetEntity=ModeFaireValoir::class, inversedBy="parcelles")
     */
    private $modeFaireValoir;

    /**
     * @ORM\ManyToOne(targetEntity=Localisation::class, inversedBy="parcelles")
     */
    private $localisation;

    /**
     * @ORM\ManyToOne(targetEntity=Milieu::class, inversedBy="parcelles")
     */
    private $milieu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $irrigation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $compaction;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $contreSaison;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $zoneErodible;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $risqueInnondation;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ancienCodeParcelle;

    /**
     * @ORM\ManyToOne(targetEntity=Anciennete::class, inversedBy="parcelles")
     */
    private $anciennete;

    /**
     * @ORM\ManyToOne(targetEntity=ZC::class)
     */
    private $zc;

    /**
     * @ORM\ManyToOne(targetEntity=EmplacementPI::class, inversedBy="parcelles")
     */
    private $emplacementPI;

    /**
     * @ORM\OneToMany(targetEntity=CultureMere::class, mappedBy="parcelle")
     */
    private $cultureMeres;

    public function __construct()
    {
        $this->cultureMeres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgriculteur(): ?Agriculteur
    {
        return $this->agriculteur;
    }

    public function setAgriculteur(?Agriculteur $agriculteur): self
    {
        $this->agriculteur = $agriculteur;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeSol(): ?TypeSol
    {
        return $this->TypeSol;
    }

    public function setTypeSol(?TypeSol $TypeSol): self
    {
        $this->TypeSol = $TypeSol;

        return $this;
    }

    public function getModeFaireValoir(): ?ModeFaireValoir
    {
        return $this->modeFaireValoir;
    }

    public function setModeFaireValoir(?ModeFaireValoir $modeFaireValoir): self
    {
        $this->modeFaireValoir = $modeFaireValoir;

        return $this;
    }

    public function getLocalisation(): ?localisation
    {
        return $this->localisation;
    }

    public function setLocalisation(?localisation $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getMilieu(): ?Milieu
    {
        return $this->milieu;
    }

    public function setMilieu(?Milieu $milieu): self
    {
        $this->milieu = $milieu;

        return $this;
    }

    public function getIrrigation(): ?bool
    {
        return $this->irrigation;
    }

    public function setIrrigation(?bool $irrigation): self
    {
        $this->irrigation = $irrigation;

        return $this;
    }

    public function getCompaction(): ?bool
    {
        return $this->compaction;
    }

    public function setCompaction(?bool $compaction): self
    {
        $this->compaction = $compaction;

        return $this;
    }

    public function getContreSaison(): ?bool
    {
        return $this->contreSaison;
    }

    public function setContreSaison(?bool $contreSaison): self
    {
        $this->contreSaison = $contreSaison;

        return $this;
    }

    public function getZoneErodible(): ?bool
    {
        return $this->zoneErodible;
    }

    public function setZoneErodible(?bool $zoneErodible): self
    {
        $this->zoneErodible = $zoneErodible;

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

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getRisqueInnondation(): ?bool
    {
        return $this->risqueInnondation;
    }

    public function setRisqueInnondation(?bool $risqueInnondation): self
    {
        $this->risqueInnondation = $risqueInnondation;

        return $this;
    }

    public function getAncienCodeParcelle(): ?string
    {
        return $this->ancienCodeParcelle;
    }

    public function setAncienCodeParcelle(?string $ancienCodeParcelle): self
    {
        $this->ancienCodeParcelle = $ancienCodeParcelle;

        return $this;
    }

    public function getAnciennete(): ?Anciennete
    {
        return $this->anciennete;
    }

    public function setAnciennete(?Anciennete $anciennete): self
    {
        $this->anciennete = $anciennete;

        return $this;
    }

    public function getZc(): ?ZC
    {
        return $this->zc;
    }

    public function setZc(?ZC $zc): self
    {
        $this->zc = $zc;

        return $this;
    }

    public function getEmplacementPI(): ?EmplacementPI
    {
        return $this->emplacementPI;
    }

    public function setEmplacementPI(?EmplacementPI $emplacementPI): self
    {
        $this->emplacementPI = $emplacementPI;

        return $this;
    }

    /**
     * @return Collection|CultureMere[]
     */
    public function getCultureMeres(): Collection
    {
        return $this->cultureMeres;
    }

    public function addCultureMere(CultureMere $cultureMere): self
    {
        if (!$this->cultureMeres->contains($cultureMere)) {
            $this->cultureMeres[] = $cultureMere;
            $cultureMere->setParcelle($this);
        }

        return $this;
    }

    public function removeCultureMere(CultureMere $cultureMere): self
    {
        if ($this->cultureMeres->contains($cultureMere)) {
            $this->cultureMeres->removeElement($cultureMere);
            // set the owning side to null (unless already changed)
            if ($cultureMere->getParcelle() === $this) {
                $cultureMere->setParcelle(null);
            }
        }

        return $this;
    }
}
