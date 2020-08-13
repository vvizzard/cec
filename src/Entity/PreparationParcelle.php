<?php

namespace App\Entity;

use App\Repository\PreparationParcelleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PreparationParcelleRepository::class)
 */
class PreparationParcelle
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
     * @ORM\OneToMany(targetEntity=CultureMere::class, mappedBy="preparationParcelle")
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
            $cultureMere->setPreparationParcelle($this);
        }

        return $this;
    }

    public function removeCultureMere(CultureMere $cultureMere): self
    {
        if ($this->cultureMeres->contains($cultureMere)) {
            $this->cultureMeres->removeElement($cultureMere);
            // set the owning side to null (unless already changed)
            if ($cultureMere->getPreparationParcelle() === $this) {
                $cultureMere->setPreparationParcelle(null);
            }
        }

        return $this;
    }
}
