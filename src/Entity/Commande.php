<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $produits_commande = [];

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $hourRecup = null;

    /**
     * @var Collection<int, Historique>
     */
    #[ORM\ManyToMany(targetEntity: Historique::class, inversedBy: 'commandes')]
    private Collection $historique;

    /**
     * @var Collection<int, user>
     */
    #[ORM\ManyToMany(targetEntity: user::class, inversedBy: 'commandes')]
    private Collection $UserCommande;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\ManyToMany(targetEntity: Produit::class, mappedBy: 'commande')]
    private Collection $produits;

    public function __construct()
    {
        $this->historique = new ArrayCollection();
        $this->UserCommande = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduitsCommande(): array
    {
        return $this->produits_commande;
    }

    public function setProduitsCommande(array $produits_commande): static
    {
        $this->produits_commande = $produits_commande;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHourRecup(): ?string
    {
        return $this->hourRecup;
    }

    public function setHourRecup(string $hourRecup): static
    {
        $this->hourRecup = $hourRecup;

        return $this;
    }

    /**
     * @return Collection<int, Historique>
     */
    public function getHistorique(): Collection
    {
        return $this->historique;
    }

    public function addHistorique(Historique $historique): static
    {
        if (!$this->historique->contains($historique)) {
            $this->historique->add($historique);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): static
    {
        $this->historique->removeElement($historique);

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUserCommande(): Collection
    {
        return $this->UserCommande;
    }

    public function addUserCommande(user $userCommande): static
    {
        if (!$this->UserCommande->contains($userCommande)) {
            $this->UserCommande->add($userCommande);
        }

        return $this;
    }

    public function removeUserCommande(user $userCommande): static
    {
        $this->UserCommande->removeElement($userCommande);

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->addCommande($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            $produit->removeCommande($this);
        }

        return $this;
    }
}
