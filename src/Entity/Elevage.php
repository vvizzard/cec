<?php

namespace App\Entity;

use App\Repository\ElevageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElevageRepository::class)
 */
class Elevage
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
     * @ORM\Column(type="boolean")
     */
    private $rente;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Agriculteur::class, mappedBy="elevage")
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

    public function getRente(): ?bool
    {
        return $this->rente;
    }

    public function setRente(bool $rente): self
    {
        $this->rente = $rente;

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
            $agriculteur->setElevage($this);
        }

        return $this;
    }

    public function removeAgriculteur(Agriculteur $agriculteur): self
    {
        if ($this->agriculteurs->contains($agriculteur)) {
            $this->agriculteurs->removeElement($agriculteur);
            // set the owning side to null (unless already changed)
            if ($agriculteur->getElevage() === $this) {
                $agriculteur->setElevage(null);
            }
        }

        return $this;
    }
}
