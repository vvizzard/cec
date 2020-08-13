<?php

namespace App\Entity;

use App\Repository\ItineraireCulturalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItineraireCulturalRepository::class)
 */
class ItineraireCultural
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
     * @ORM\ManyToOne(targetEntity=SystemeCultural::class, inversedBy="itineraireCulturals")
     */
    private $systeme;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $riz;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $vivrierHors;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rmme;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pcEnPure;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $couvertureCultureRente;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $reforestation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cultureRente;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pcAssocie;

    /**
     * @ORM\OneToMany(targetEntity=CultureMere::class, mappedBy="itineraireCultural")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSysteme(): ?SystemeCultural
    {
        return $this->systeme;
    }

    public function setSysteme(?SystemeCultural $systeme): self
    {
        $this->systeme = $systeme;

        return $this;
    }

    public function getRiz(): ?bool
    {
        return $this->riz;
    }

    public function setRiz(?bool $riz): self
    {
        $this->riz = $riz;

        return $this;
    }

    public function getVivrierHors(): ?bool
    {
        return $this->vivrierHors;
    }

    public function setVivrierHors(?bool $vivrierHors): self
    {
        $this->vivrierHors = $vivrierHors;

        return $this;
    }

    public function getRmme(): ?bool
    {
        return $this->rmme;
    }

    public function setRmme(?bool $rmme): self
    {
        $this->rmme = $rmme;

        return $this;
    }

    public function getPcEnPure(): ?bool
    {
        return $this->pcEnPure;
    }

    public function setPcEnPure(?bool $pcEnPure): self
    {
        $this->pcEnPure = $pcEnPure;

        return $this;
    }

    public function getCouvertureCultureRente(): ?bool
    {
        return $this->couvertureCultureRente;
    }

    public function setCouvertureCultureRente(?bool $couvertureCultureRente): self
    {
        $this->couvertureCultureRente = $couvertureCultureRente;

        return $this;
    }

    public function getReforestation(): ?bool
    {
        return $this->reforestation;
    }

    public function setReforestation(?bool $reforestation): self
    {
        $this->reforestation = $reforestation;

        return $this;
    }

    public function getCultureRente(): ?bool
    {
        return $this->cultureRente;
    }

    public function setCultureRente(?bool $cultureRente): self
    {
        $this->cultureRente = $cultureRente;

        return $this;
    }

    public function getPcAssocie(): ?bool
    {
        return $this->pcAssocie;
    }

    public function setPcAssocie(?bool $pcAssocie): self
    {
        $this->pcAssocie = $pcAssocie;

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
            $cultureMere->setItineraireCultural($this);
        }

        return $this;
    }

    public function removeCultureMere(CultureMere $cultureMere): self
    {
        if ($this->cultureMeres->contains($cultureMere)) {
            $this->cultureMeres->removeElement($cultureMere);
            // set the owning side to null (unless already changed)
            if ($cultureMere->getItineraireCultural() === $this) {
                $cultureMere->setItineraireCultural(null);
            }
        }

        return $this;
    }
}
