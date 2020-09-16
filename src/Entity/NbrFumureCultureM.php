<?php

namespace App\Entity;

use App\Repository\NbrFumureCultureMRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NbrFumureCultureMRepository::class)
 */
class NbrFumureCultureM
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=FumureOrganique::class)
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $fumure;

    /**
     * @ORM\ManyToOne(targetEntity=CultureMere::class, inversedBy="nbrFumureCultureMs")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $culture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFumure(): ?FumureOrganique
    {
        return $this->fumure;
    }

    public function setFumure(?FumureOrganique $fumure): self
    {
        $this->fumure = $fumure;

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
