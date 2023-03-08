<?php

namespace App\Entity;

use App\Repository\CameraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CameraRepository::class)]
class Camera
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Ouverture = null;

    #[ORM\Column(length: 255)]
    private ?string $resolution = null;

    #[ORM\Column]
    private ?int $fov = null;

    #[ORM\Column]
    private ?bool $stabilise = null;

    #[ORM\ManyToOne(inversedBy: 'camera')]
    private ?Drones $drones = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOuverture(): ?float
    {
        return $this->Ouverture;
    }

    public function setOuverture(float $Ouverture): self
    {
        $this->Ouverture = $Ouverture;

        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    public function setResolution(string $resolution): self
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function getFov(): ?int
    {
        return $this->fov;
    }

    public function setFov(int $fov): self
    {
        $this->fov = $fov;

        return $this;
    }

    public function isStabilise(): ?bool
    {
        return $this->stabilise;
    }

    public function setStabilise(bool $stabilise): self
    {
        $this->stabilise = $stabilise;

        return $this;
    }

    public function getDrones(): ?Drones
    {
        return $this->drones;
    }

    public function setDrones(?Drones $drones): self
    {
        $this->drones = $drones;

        return $this;
    }
}
