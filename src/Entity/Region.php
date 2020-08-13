<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SousRegion::class, mappedBy="region")
     */
    private $sousRegions;

    /**
     * @ORM\OneToMany(targetEntity=Agriculteur::class, mappedBy="region")
     */
    private $agriculteurs;

    public function __construct()
    {
        $this->sousRegions = new ArrayCollection();
        $this->agriculteurs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|SousRegion[]
     */
    public function getSousRegions(): Collection
    {
        return $this->sousRegions;
    }

    public function addSousRegion(SousRegion $sousRegion): self
    {
        if (!$this->sousRegions->contains($sousRegion)) {
            $this->sousRegions[] = $sousRegion;
            $sousRegion->setRegion($this);
        }

        return $this;
    }

    public function removeSousRegion(SousRegion $sousRegion): self
    {
        if ($this->sousRegions->contains($sousRegion)) {
            $this->sousRegions->removeElement($sousRegion);
            // set the owning side to null (unless already changed)
            if ($sousRegion->getRegion() === $this) {
                $sousRegion->setRegion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Agriculteur[]
     */
    public function getAgriculteurs(): Collection
    {
        return $this->agriculteurs;
    }

    public function addAgriculteur(Agriculteur $agriculteur): self
    {
        if (!$this->agriculteurs->contains($agriculteur)) {
            $this->agriculteurs[] = $agriculteur;
            $agriculteur->setRegion($this);
        }

        return $this;
    }

    public function removeAgriculteur(Agriculteur $agriculteur): self
    {
        if ($this->agriculteurs->contains($agriculteur)) {
            $this->agriculteurs->removeElement($agriculteur);
            // set the owning side to null (unless already changed)
            if ($agriculteur->getRegion() === $this) {
                $agriculteur->setRegion(null);
            }
        }

        return $this;
    }
}
