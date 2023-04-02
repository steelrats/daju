<?php

namespace App\Entity;

use App\Repository\CameraRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CameraRepository::class)]
class Camera
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $ouverture = null;

    #[ORM\Column(length: 255)]
    private ?string $resolution = null;

    #[ORM\Column]
    private ?int $fov = null;

    #[ORM\Column]
    private ?bool $stabilise = null;

    #[ORM\OneToMany(mappedBy: 'camera', targetEntity: Drones::class)]
    private Collection $drone;

    #[ORM\Column]
    private ?int $resolutionVertical = null;

    #[ORM\Column]
    private ?int $resolutionHorizontal = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->drone = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable('now');
    }

    public function __toString(): string
    {
        return (string) 'ouverture : f/'.$this->getOuverture().' Resolution : '.$this->getResolution().' Angle de vision : '.$this->getFov().'° stabilise : '.$this->isStabilise();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOuverture(): ?float
    {
        return $this->ouverture;
    }

    public function setOuverture(float $ouverture): self
    {
        $this->ouverture = $ouverture;

        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    private function setResolution(string $resolution): self
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

    /**
     * @return Collection<int, Drones>
     */
    public function getDrone(): Collection
    {
        return $this->drone;
    }

    public function addDrone(Drones $drone): self
    {
        if (!$this->drone->contains($drone)) {
            $this->drone->add($drone);
            $drone->setCamera($this);
        }

        return $this;
    }

    public function removeDrone(Drones $drone): self
    {
        if ($this->drone->removeElement($drone)) {
            // set the owning side to null (unless already changed)
            if ($drone->getCamera() === $this) {
                $drone->setCamera(null);
            }
        }

        return $this;
    }

    public function getResolutionVertical(): ?int
    {
        return $this->resolutionVertical;
    }

    public function setResolutionVertical(int $resolutionVertical): self
    {
        $this->resolutionVertical = $resolutionVertical;

        switch ($resolutionVertical) {
            case 4320:
                $this->setResolution("8K");
                break;
            case 3078:
                $this->setResolution("5.3K");
                break;
            case 2160:
                $this->setResolution("4K");
                break;
            case 1440:
                $this->setResolution("2K");
                break;
            case 1080:
                $this->setResolution("Full HD");
                break;
            case 720:
                $this->setResolution("HD");
                break;
            default:
                if ($resolutionVertical < 720) {
                    $this->setResolution("SD");
                } else {
                    $this->setResolution("Inconue");
                }
                break;
        }

        return $this;
    }

    public function getResolutionHorizontal(): ?int
    {
        return $this->resolutionHorizontal;
    }

    public function setResolutionHorizontal(int $resolutionHorizontal): self
    {
        $this->resolutionHorizontal = $resolutionHorizontal;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
