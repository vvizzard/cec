<?php

namespace App\Entity;

use App\Repository\SystemeCulturalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SystemeCulturalRepository::class)
 */
class SystemeCultural
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
     * @ORM\ManyToOne(targetEntity=Milieu::class, inversedBy="systemeCulturals")
     */
    private $milieu;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $systemeCulturalExport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ItineraireCultural::class, mappedBy="systeme")
     */
    private $itineraireCulturals;

    /**
     * @ORM\OneToMany(targetEntity=CultureMere::class, mappedBy="systemeCultural")
     */
    private $cultureMeres;

    public function __construct()
    {
        $this->itineraireCulturals = new ArrayCollection();
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

    public function getMilieu(): ?Milieu
    {
        return $this->milieu;
    }

    public function setMilieu(?Milieu $milieu): self
    {
        $this->milieu = $milieu;

        return $this;
    }

    public function getSystemeCulturalExport(): ?string
    {
        return $this->systemeCulturalExport;
    }

    public function setSystemeCulturalExport(?string $systemeCulturalExport): self
    {
        $this->systemeCulturalExport = $systemeCulturalExport;

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
     * @return Collection|ItineraireCultural[]
     */
    public function getItineraireCulturals(): Collection
    {
        return $this->itineraireCulturals;
    }

    public function addItineraireCultural(ItineraireCultural $itineraireCultural): self
    {
        if (!$this->itineraireCulturals->contains($itineraireCultural)) {
            $this->itineraireCulturals[] = $itineraireCultural;
            $itineraireCultural->setSysteme($this);
        }

        return $this;
    }

    public function removeItineraireCultural(ItineraireCultural $itineraireCultural): self
    {
        if ($this->itineraireCulturals->contains($itineraireCultural)) {
            $this->itineraireCulturals->removeElement($itineraireCultural);
            // set the owning side to null (unless already changed)
            if ($itineraireCultural->getSysteme() === $this) {
                $itineraireCultural->setSysteme(null);
            }
        }

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
            $cultureMere->setSystemeCultural($this);
        }

        return $this;
    }

    public function removeCultureMere(CultureMere $cultureMere): self
    {
        if ($this->cultureMeres->contains($cultureMere)) {
            $this->cultureMeres->removeElement($cultureMere);
            // set the owning side to null (unless already changed)
            if ($cultureMere->getSystemeCultural() === $this) {
                $cultureMere->setSystemeCultural(null);
            }
        }

        return $this;
    }
}
