<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DayRepository::class)]
#[ApiResource(
    paginationItemsPerPage:6,
    paginationClientItemsPerPage: true,
)]
#[ORM\Table(name: '`Day`')]
class Day
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Marche>
     */
    #[ORM\ManyToMany(targetEntity: Marche::class, inversedBy: 'days')]
    private Collection $marche;

    public function __construct()
    {
        $this->marche = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name ?? 'Unknown Day'; // Fallback to a default string if name is null
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Marche>
     */
    public function getMarche(): Collection
    {
        return $this->marche;
    }

    public function addMarche(Marche $marche): static
    {
        if (!$this->marche->contains($marche)) {
            $this->marche->add($marche);
        }

        return $this;
    }

    public function removeMarche(Marche $marche): static
    {
        $this->marche->removeElement($marche);

        return $this;
    }
}
