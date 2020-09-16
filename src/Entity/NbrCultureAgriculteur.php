<?php

namespace App\Entity;

use App\Repository\NbrCultureAgriculteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NbrCultureAgriculteurRepository::class)
 */
class NbrCultureAgriculteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Culture::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $culture;

    /**
     * @ORM\ManyToOne(targetEntity=Agriculteur::class, inversedBy="nbrCultureAgriculteur")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $agriculteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAgriculteur(): ?Agriculteur
    {
        return $this->agriculteur;
    }

    public function setAgriculteur(?Agriculteur $agriculteur): self
    {
        $this->agriculteur = $agriculteur;

        return $this;
    }

    public function getNbr(): ?int
    {
        return $this->nbr;
    }

    public function setNbr(int $nbr): self
    {
        $this->nbr = $nbr;

        return $this;
    }
}
