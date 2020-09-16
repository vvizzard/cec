<?php

namespace App\Entity;

use App\Repository\NbrElevageAgriculteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NbrElevageAgriculteurRepository::class)
 */
class NbrElevageAgriculteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Agriculteur::class, inversedBy="nbrElevageAgriculteurs")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $agriculteur;

    /**
     * @ORM\ManyToOne(targetEntity=Elevage::class)
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $elevage;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getElevage(): ?Elevage
    {
        return $this->elevage;
    }

    public function setElevage(?Elevage $elevage): self
    {
        $this->elevage = $elevage;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
