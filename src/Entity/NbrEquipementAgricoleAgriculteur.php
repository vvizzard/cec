<?php

namespace App\Entity;

use App\Repository\NbrEquipementAgricoleAgriculteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NbrEquipementAgricoleAgriculteurRepository::class)
 */
class NbrEquipementAgricoleAgriculteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=EquipementAgricole::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipementAgricole;

    /**
     * @ORM\ManyToOne(targetEntity=agriculteur::class, inversedBy="nbrEquipementAgricoleAgriculteur")
     * @ORM\JoinColumn(nullable=false)
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

    public function getEquipementAgricole(): ?EquipementAgricole
    {
        return $this->equipementAgricole;
    }

    public function setEquipementAgricole(?EquipementAgricole $equipementAgricole): self
    {
        $this->equipementAgricole = $equipementAgricole;

        return $this;
    }

    public function getAgriculteur(): ?agriculteur
    {
        return $this->agriculteur;
    }

    public function setAgriculteur(?agriculteur $agriculteur): self
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
