<?php

namespace App\Entity;

use App\Repository\CultureFilleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CultureFilleRepository::class)
 */
class CultureFille
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Culture::class, inversedBy="cultureFilles")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $plante;

    /**
     * @ORM\ManyToOne(targetEntity=Variete::class, inversedBy="cultureFilles")
     */
    private $variete;

    /**
     * @ORM\ManyToOne(targetEntity=AgePlant::class)
     */
    private $agePlant;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datePlantation;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $QteSemence;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $production;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $rdt;

    /**
     * @ORM\ManyToOne(targetEntity=CultureMere::class, inversedBy="cultureFilles")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $cultureMere;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixUnitaireSemence;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixUnitaireProduit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateRecolte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlante(): ?Culture
    {
        return $this->plante;
    }

    public function getPlanteString(): ?String
    {
        return $this->plante ? $this->plante->getNom() : null;
    }

    public function setPlante(?Culture $plante): self
    {
        $this->plante = $plante;

        return $this;
    }

    public function getVariete(): ?Variete
    {
        return $this->variete;
    }

    public function getVarieteString(): ?String
    {
        return $this->variete ? $this->variete->getNom() : null;
    }

    public function setVariete(?Variete $variete): self
    {
        $this->variete = $variete;

        return $this;
    }

    public function getAgePlant(): ?AgePlant
    {
        return $this->agePlant;
    }

    public function setAgePlant(?AgePlant $agePlant): self
    {
        $this->agePlant = $agePlant;

        return $this;
    }

    public function getDatePlantation(): ?\DateTimeInterface
    {
        return $this->datePlantation;
    }

    public function setDatePlantation(?\DateTimeInterface $datePlantation): self
    {
        $this->datePlantation = $datePlantation;

        return $this;
    }

    public function setDatePlantationString($datePlantation): self
    {
        if ($datePlantation != null) {
            $this->datePlantation = \DateTime::createFromFormat('Y-m-d H:i:s', $datePlantation);
        }

        return $this;
    }

    public function getQteSemence(): ?string
    {
        return $this->QteSemence;
    }

    public function setQteSemence(?string $QteSemence): self
    {
        $this->QteSemence = $QteSemence;

        return $this;
    }

    public function getProduction(): ?string
    {
        return $this->production;
    }

    public function setProduction(?string $production): self
    {
        $this->production = $production;

        return $this;
    }

    public function getRdt(): ?string
    {
        return $this->rdt;
    }

    public function setRdt(?string $rdt): self
    {
        $this->rdt = $rdt;

        return $this;
    }

    public function getCultureMere(): ?CultureMere
    {
        return $this->cultureMere;
    }

    public function setCultureMere(?CultureMere $cultureMere): self
    {
        $this->cultureMere = $cultureMere;

        return $this;
    }

    public function getPrixUnitaireSemence(): ?int
    {
        return $this->prixUnitaireSemence;
    }

    public function setPrixUnitaireSemence(?int $prixUnitaireSemence): self
    {
        $this->prixUnitaireSemence = $prixUnitaireSemence;

        return $this;
    }

    public function getPrixUnitaireProduit(): ?int
    {
        return $this->prixUnitaireProduit;
    }

    public function setPrixUnitaireProduit(?int $prixUnitaireProduit): self
    {
        $this->prixUnitaireProduit = $prixUnitaireProduit;

        return $this;
    }

    public function getDateRecolte(): ?\DateTimeInterface
    {
        return $this->dateRecolte;
    }

    public function setDateRecolte(?\DateTimeInterface $dateRecolte): self
    {
        $this->dateRecolte = $dateRecolte;

        return $this;
    }

    public function setDateRecolteString($dateRecolte): self
    {
        if ($dateRecolte != null) {
            $this->dateRecolte = \DateTime::createFromFormat('Y-m-d H:i:s', $dateRecolte);
        }

        return $this;
    }
    
}
