<?php

namespace App\Entity;

use App\Repository\MilieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MilieuRepository::class)
 */
class Milieu
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
     * @ORM\OneToMany(targetEntity=Parcelle::class, mappedBy="milieu")
     */
    private $parcelles;

    /**
     * @ORM\OneToMany(targetEntity=SystemeCultural::class, mappedBy="milieu")
     */
    private $systemeCulturals;

    public function __construct()
    {
        $this->parcelles = new ArrayCollection();
        $this->systemeCulturals = new ArrayCollection();
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
     * @return Collection|Parcelle[]
     */
    public function getParcelles(): Collection
    {
        return $this->parcelles;
    }

    public function addParcelle(Parcelle $parcelle): self
    {
        if (!$this->parcelles->contains($parcelle)) {
            $this->parcelles[] = $parcelle;
            $parcelle->setMilieu($this);
        }

        return $this;
    }

    public function removeParcelle(Parcelle $parcelle): self
    {
        if ($this->parcelles->contains($parcelle)) {
            $this->parcelles->removeElement($parcelle);
            // set the owning side to null (unless already changed)
            if ($parcelle->getMilieu() === $this) {
                $parcelle->setMilieu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SystemeCultural[]
     */
    public function getSystemeCulturals(): Collection
    {
        return $this->systemeCulturals;
    }

    public function addSystemeCultural(SystemeCultural $systemeCultural): self
    {
        if (!$this->systemeCulturals->contains($systemeCultural)) {
            $this->systemeCulturals[] = $systemeCultural;
            $systemeCultural->setMilieu($this);
        }

        return $this;
    }

    public function removeSystemeCultural(SystemeCultural $systemeCultural): self
    {
        if ($this->systemeCulturals->contains($systemeCultural)) {
            $this->systemeCulturals->removeElement($systemeCultural);
            // set the owning side to null (unless already changed)
            if ($systemeCultural->getMilieu() === $this) {
                $systemeCultural->setMilieu(null);
            }
        }

        return $this;
    }
}
