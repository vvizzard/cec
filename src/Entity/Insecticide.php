<?php

namespace App\Entity;

use App\Repository\InsecticideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InsecticideRepository::class)
 */
class Insecticide
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
     * @ORM\OneToMany(targetEntity=NbrInsecticideCultureM::class, mappedBy="insecticide")
     */
    private $nbrInsecticideCultureMs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prix;

    public function __construct()
    {
        $this->nbrInsecticideCultureMs = new ArrayCollection();
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
     * @return Collection|NbrInsecticideCultureM[]
     */
    public function getNbrInsecticideCultureMs(): Collection
    {
        return $this->nbrInsecticideCultureMs;
    }

    public function addNbrInsecticideCultureM(NbrInsecticideCultureM $nbrInsecticideCultureM): self
    {
        if (!$this->nbrInsecticideCultureMs->contains($nbrInsecticideCultureM)) {
            $this->nbrInsecticideCultureMs[] = $nbrInsecticideCultureM;
            $nbrInsecticideCultureM->setInsecticide($this);
        }

        return $this;
    }

    public function removeNbrInsecticideCultureM(NbrInsecticideCultureM $nbrInsecticideCultureM): self
    {
        if ($this->nbrInsecticideCultureMs->contains($nbrInsecticideCultureM)) {
            $this->nbrInsecticideCultureMs->removeElement($nbrInsecticideCultureM);
            // set the owning side to null (unless already changed)
            if ($nbrInsecticideCultureM->getInsecticide() === $this) {
                $nbrInsecticideCultureM->setInsecticide(null);
            }
        }

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
