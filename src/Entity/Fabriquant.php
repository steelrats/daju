<?php

namespace App\Entity;

use App\Repository\FabriquantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FabriquantRepository::class)]
class Fabriquant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'fabriquant', targetEntity: Drones::class)]
    private Collection $drones;

    public function __construct()
    {
        $this->drones = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->getNom();
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

    /**
     * @return Collection<int, Drones>
     */
    public function getDrones(): Collection
    {
        return $this->drones;
    }

    public function addDrone(Drones $drone): self
    {
        if (!$this->drones->contains($drone)) {
            $this->drones->add($drone);
            $drone->setFabriquant($this);
        }

        return $this;
    }

    public function removeDrone(Drones $drone): self
    {
        if ($this->drones->removeElement($drone)) {
            // set the owning side to null (unless already changed)
            if ($drone->getFabriquant() === $this) {
                $drone->setFabriquant(null);
            }
        }

        return $this;
    }
}
