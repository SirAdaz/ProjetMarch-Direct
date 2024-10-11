<?php

namespace App\Entity;

use App\Repository\MarcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: MarcheRepository::class)]
#[ApiResource(
    paginationItemsPerPage:6,
    paginationClientItemsPerPage: true,
)]
#[ORM\Table(name: '`Marche`')]
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
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'commercant_marche')]
    private Collection $commercant_marche;

    #[ORM\Column(length: 255)]
    private ?string $hourly = null;

    /**
     * @var Collection<int, Day>
     */
    #[ORM\ManyToMany(targetEntity: Day::class, mappedBy: 'marche')]
    private Collection $days;

    #[ORM\Column(length: 255)]
    private ?string $imageFileName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    public function __construct()
    {
        $this->commercant_marche = new ArrayCollection();
        $this->days = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->marcheName ?? 'Unknown Marche'; // Fallback to a default string if name is null
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
     * @return Collection<int, User>
     */
    public function getCommercantMarche(): Collection
    {
        return $this->commercant_marche;
    }

    public function addCommercantMarche(User $commercantMarche): static
    {
        if (!$this->commercant_marche->contains($commercantMarche)) {
            $this->commercant_marche->add($commercantMarche);
        }

        return $this;
    }

    public function removeCommercantMarche(User $commercantMarche): static
    {
        $this->commercant_marche->removeElement($commercantMarche);

        return $this;
    }

    public function getHourly(): ?string
    {
        return $this->hourly;
    }

    public function setHourly(string $hourly): static
    {
        $this->hourly = $hourly;

        return $this;
    }

    /**
     * @return Collection<int, Day>
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(Day $day): static
    {
        if (!$this->days->contains($day)) {
            $this->days->add($day);
            $day->addMarche($this);
        }

        return $this;
    }

    public function removeDay(Day $day): static
    {
        if ($this->days->removeElement($day)) {
            $day->removeMarche($this);
        }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
