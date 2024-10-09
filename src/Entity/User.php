<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use ApiPlatform\Metadata\ApiResource;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
#[ORM\Table(name: '`User`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameBusiness = null;

    #[ORM\Column(nullable: true)]
    private ?array $stats = null;

    /**
     * @var Collection<int, Marche>
     */
    #[ORM\ManyToMany(targetEntity: Marche::class, mappedBy: 'commercant_marche')]
    private Collection $commercant_marche;

    /**
     * @var Collection<int, Historique>
     */
    #[ORM\OneToMany(targetEntity: Historique::class, mappedBy: 'userHisto')]
    private Collection $historiques;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'UserCommande')]
    private Collection $commandes;

    /**
     * @var Collection<int, Produit>
    */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'userProduct')]
    private Collection $produits;

    #[ORM\Column(length: 255)]
    #[Vich\UploadableField(mapping: 'products', fileNameProperty: 'imageFileName')]
    private ?string $imageFileName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionCommerce = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $placeMarche = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\ManyToMany(targetEntity: Comment::class, mappedBy: 'userComment')]
    private Collection $comments;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDeCreation = null;

    #[ORM\Column]
    private ?bool $verif = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numSiret = null;

    /**
     * @var Collection<int, categorie>
     */
    #[ORM\ManyToMany(targetEntity: categorie::class, inversedBy: 'users')]
    private Collection $userCategorie;

    public function __construct()
    {
        $this->commercant_marche = new ArrayCollection();
        $this->historiques = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->produits = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->userCategorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getNameBusiness(): ?string
    {
        return $this->nameBusiness;
    }

    public function setNameBusiness(string $nameBusiness): static
    {
        $this->nameBusiness = $nameBusiness;

        return $this;
    }

    public function getStats(): ?array
    {
        return $this->stats;
    }

    public function setStats(?array $stats): static
    {
        $this->stats = $stats;

        return $this;
    }

    /**
     * @return Collection<int, Marche>
     */
    public function getCommercantMarche(): Collection
    {
        return $this->commercant_marche;
    }

    public function addCommercantMarche(Marche $commercantMarche): static
    {
        if (!$this->commercant_marche->contains($commercantMarche)) {
            $this->commercant_marche->add($commercantMarche);
            $commercantMarche->addCommercantMarche($this);
        }

        return $this;
    }

    public function removeCommercantMarche(Marche $commercantMarche): static
    {
        if ($this->commercant_marche->removeElement($commercantMarche)) {
            $commercantMarche->removeCommercantMarche($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Historique>
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historique $historique): static
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques->add($historique);
            $historique->setUserHisto($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): static
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getUserHisto() === $this) {
                $historique->setUserHisto(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->addUserCommande($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeUserCommande($this);
        }

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
            $produit->setUserProduct($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getUserProduct() === $this) {
                $produit->setUserProduct(null);
            }
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

    public function getDescriptionCommerce(): ?string
    {
        return $this->descriptionCommerce;
    }

    public function setDescriptionCommerce(string $descriptionCommerce): static
    {
        $this->descriptionCommerce = $descriptionCommerce;

        return $this;
    }

    public function getPlaceMarche(): ?string
    {
        return $this->placeMarche;
    }

    public function setPlaceMarche(string $placeMarche): static
    {
        $this->placeMarche = $placeMarche;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->addUserComment($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            $comment->removeUserComment($this);
        }

        return $this;
    }

    public function getDateDeCreation(): ?\DateTimeInterface
    {
        return $this->dateDeCreation;
    }

    public function setDateDeCreation(\DateTimeInterface $dateDeCreation): static
    {
        $this->dateDeCreation = $dateDeCreation;

        return $this;
    }

    public function isVerif(): ?bool
    {
        return $this->verif;
    }

    public function setVerif(bool $verif): static
    {
        $this->verif = $verif;

        return $this;
    }

    public function getNumSiret(): ?string
    {
        return $this->numSiret;
    }

    public function setNumSiret(?string $numSiret): static
    {
        $this->numSiret = $numSiret;

        return $this;
    }

    /**
     * @return Collection<int, categorie>
     */
    public function getUserCategorie(): Collection
    {
        return $this->userCategorie;
    }

    public function addUserCategorie(categorie $userCategorie): static
    {
        if (!$this->userCategorie->contains($userCategorie)) {
            $this->userCategorie->add($userCategorie);
        }

        return $this;
    }

    public function removeUserCategorie(categorie $userCategorie): static
    {
        $this->userCategorie->removeElement($userCategorie);

        return $this;
    }
}
