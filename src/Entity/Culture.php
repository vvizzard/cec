<?php

namespace App\Entity;

use App\Repository\CultureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CultureRepository::class)
 */
class Culture
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rente;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Agriculteur::class, mappedBy="culture")
     */
    private $agriculteurs;

    /**
     * @ORM\OneToMany(targetEntity=Variete::class, mappedBy="culture")
     */
    private $varietes;

    /**
     * @ORM\OneToMany(targetEntity=CultureFille::class, mappedBy="plante")
     */
    private $cultureFilles;

    public function __construct()
    {
        $this->agriculteurs = new ArrayCollection();
        $this->varietes = new ArrayCollection();
        $this->cultureFilles = new ArrayCollection();
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

    public function setRente(?bool $rente): self
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
            $agriculteur->setCulture($this);
        }

        return $this;
    }

    public function removeAgriculteur(Agriculteur $agriculteur): self
    {
        if ($this->agriculteurs->contains($agriculteur)) {
            $this->agriculteurs->removeElement($agriculteur);
            // set the owning side to null (unless already changed)
            if ($agriculteur->getCulture() === $this) {
                $agriculteur->setCulture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Variete[]
     */
    public function getVarietes(): Collection
    {
        return $this->varietes;
    }

    public function addVariete(Variete $variete): self
    {
        if (!$this->varietes->contains($variete)) {
            $this->varietes[] = $variete;
            $variete->setCulture($this);
        }

        return $this;
    }

    public function removeVariete(Variete $variete): self
    {
        if ($this->varietes->contains($variete)) {
            $this->varietes->removeElement($variete);
            // set the owning side to null (unless already changed)
            if ($variete->getCulture() === $this) {
                $variete->setCulture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CultureFille[]
     */
    public function getCultureFilles(): Collection
    {
        return $this->cultureFilles;
    }

    public function addCultureFille(CultureFille $cultureFille): self
    {
        if (!$this->cultureFilles->contains($cultureFille)) {
            $this->cultureFilles[] = $cultureFille;
            $cultureFille->setPlante($this);
        }

        return $this;
    }

    public function removeCultureFille(CultureFille $cultureFille): self
    {
        if ($this->cultureFilles->contains($cultureFille)) {
            $this->cultureFilles->removeElement($cultureFille);
            // set the owning side to null (unless already changed)
            if ($cultureFille->getPlante() === $this) {
                $cultureFille->setPlante(null);
            }
        }

        return $this;
    }
}
