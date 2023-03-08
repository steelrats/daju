<?php

namespace App\Entity;

use App\Repository\DronesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DronesRepository::class)]
class Drones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $fabriquant = null;

    #[ORM\Column(length: 255)]
    private ?string $resistanceVent = null;

    #[ORM\Column]
    private ?int $poids = null;

    #[ORM\Column]
    private ?int $vitesseHorizon = null;

    #[ORM\Column]
    private ?int $vitesseVerticale = null;

    #[ORM\OneToMany(mappedBy: 'drones', targetEntity: Camera::class)]
    private Collection $camera;

    #[ORM\OneToMany(mappedBy: 'drones', targetEntity: commentaires::class, orphanRemoval: true)]
    private Collection $commentaire;

    public function __construct()
    {
        $this->camera = new ArrayCollection();
        $this->commentaire = new ArrayCollection();
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFabriquant(): ?string
    {
        return $this->fabriquant;
    }

    public function setFabriquant(string $fabriquant): self
    {
        $this->fabriquant = $fabriquant;

        return $this;
    }

    public function getResistanceVent(): ?string
    {
        return $this->resistanceVent;
    }

    public function setResistanceVent(string $resistanceVent): self
    {
        $this->resistanceVent = $resistanceVent;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getVitesseHorizon(): ?int
    {
        return $this->vitesseHorizon;
    }

    public function setVitesseHorizon(int $vitesseHorizon): self
    {
        $this->vitesseHorizon = $vitesseHorizon;

        return $this;
    }

    public function getVitesseVerticale(): ?int
    {
        return $this->vitesseVerticale;
    }

    public function setVitesseVerticale(int $vitesseVerticale): self
    {
        $this->vitesseVerticale = $vitesseVerticale;

        return $this;
    }

    /**
     * @return Collection<int, Camera>
     */
    public function getCamera(): Collection
    {
        return $this->camera;
    }

    public function addCamera(Camera $camera): self
    {
        if (!$this->camera->contains($camera)) {
            $this->camera->add($camera);
            $camera->setDrones($this);
        }

        return $this;
    }

    public function removeCamera(Camera $camera): self
    {
        if ($this->camera->removeElement($camera)) {
            // set the owning side to null (unless already changed)
            if ($camera->getDrones() === $this) {
                $camera->setDrones(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, commentaires>
     */
    public function getCommentaire(): Collection
    {
        return $this->commentaire;
    }

    public function addCommentaire(commentaires $commentaire): self
    {
        if (!$this->commentaire->contains($commentaire)) {
            $this->commentaire->add($commentaire);
            $commentaire->setDrones($this);
        }

        return $this;
    }

    public function removeCommentaire(commentaires $commentaire): self
    {
        if ($this->commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getDrones() === $this) {
                $commentaire->setDrones(null);
            }
        }

        return $this;
    }
}
