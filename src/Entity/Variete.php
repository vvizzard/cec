<?php

namespace App\Entity;

use App\Repository\VarieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VarieteRepository::class)
 */
class Variete
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
     * @ORM\ManyToOne(targetEntity=Culture::class, inversedBy="varietes")
     */
    private $culture;

    /**
     * @ORM\OneToMany(targetEntity=CultureFille::class, mappedBy="variete")
     */
    private $cultureFilles;

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
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
            $cultureFille->setVariete($this);
        }

        return $this;
    }

    public function removeCultureFille(CultureFille $cultureFille): self
    {
        if ($this->cultureFilles->contains($cultureFille)) {
            $this->cultureFilles->removeElement($cultureFille);
            // set the owning side to null (unless already changed)
            if ($cultureFille->getVariete() === $this) {
                $cultureFille->setVariete(null);
            }
        }

        return $this;
    }
}
