<?php

namespace App\Entity;

use App\Repository\MarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: MarcheRepository::class)]
#[ApiResource]
class Marche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marcheName = null;

    #[ORM\Column(length: 255)]
    private ?string $place = null;

    /**
     * @var Collection<int, user>
     */
    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'commercant_marche')]
    private Collection $commercant_marche;

    #[ORM\Column(length: 255)]
    private ?string $imageFileName = null;

    public function __construct()
    {
        $this->commercant_marche = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarcheName(): ?string
    {
        return $this->marcheName;
    }

    public function setMarcheName(string $marcheName): static
    {
        $this->marcheName = $marcheName;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): static
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getCommercantMarche(): Collection
    {
        return $this->commercant_marche;
    }

    public function addCommercantMarche(user $commercantMarche): static
    {
        if (!$this->commercant_marche->contains($commercantMarche)) {
            $this->commercant_marche->add($commercantMarche);
        }

        return $this;
    }

    public function removeCommercantMarche(user $commercantMarche): static
    {
        $this->commercant_marche->removeElement($commercantMarche);

        return $this;
    }

    public function getImageFileName(): ?string
    {
        return $this->imageFileName;
    }

    public function setImageFileName(string $imageFileName): static
    {
        $this->imageFileName = $imageFileName;

        return $this;
    }
}
