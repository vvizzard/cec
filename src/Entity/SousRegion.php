<?php

namespace App\Entity;

use App\Repository\SousRegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousRegionRepository::class)
 */
class SousRegion
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
     * @ORM\ManyToOne(targetEntity=Region::class, inversedBy="sousRegions")
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=Agriculteur::class, mappedBy="sousRegion")
     */
    private $agriculteurs;

    public function __construct()
    {
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

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

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
            $agriculteur->setSousRegion($this);
        }

        return $this;
    }

    public function removeAgriculteur(Agriculteur $agriculteur): self
    {
        if ($this->agriculteurs->contains($agriculteur)) {
            $this->agriculteurs->removeElement($agriculteur);
            // set the owning side to null (unless already changed)
            if ($agriculteur->getSousRegion() === $this) {
                $agriculteur->setSousRegion(null);
            }
        }

        return $this;
    }
}
