<?php

namespace App\Entity;

use App\Repository\NbrInsecticideCultureMRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NbrInsecticideCultureMRepository::class)
 */
class NbrInsecticideCultureM
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Insecticide::class, inversedBy="nbrInsecticideCultureMs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $insecticide;

    /**
     * @ORM\ManyToOne(targetEntity=CultureMere::class, inversedBy="nbrInsecticideCultureMs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $culture;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $nbr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInsecticide(): ?Insecticide
    {
        return $this->insecticide;
    }

    public function setInsecticide(?Insecticide $insecticide): self
    {
        $this->insecticide = $insecticide;

        return $this;
    }

    public function getCulture(): ?CultureMere
    {
        return $this->culture;
    }

    public function setCulture(?CultureMere $culture): self
    {
        $this->culture = $culture;

        return $this;
    }

    public function getNbr(): ?string
    {
        return $this->nbr;
    }

    public function setNbr(string $nbr): self
    {
        $this->nbr = $nbr;

        return $this;
    }
}
