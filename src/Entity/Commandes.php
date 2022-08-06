<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix = null;

    #[ORM\Column(length: 50)]
    private ?string $nomClient = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $nbCommandesPasse = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalDepenseSurLeSite = null;

    #[ORM\Column(length: 50)]
    private ?string $etatDeLaCommande = null;

    #[ORM\OneToMany(mappedBy: 'commandes', targetEntity: Adresse::class)]
    private Collection $adresses;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?MoyenPaiement $moyenPaiement = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Panier $panier = null;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNbCommandesPasse(): ?int
    {
        return $this->nbCommandesPasse;
    }

    public function setNbCommandesPasse(int $nbCommandesPasse): self
    {
        $this->nbCommandesPasse = $nbCommandesPasse;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(?\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getTotalDepenseSurLeSite(): ?float
    {
        return $this->totalDepenseSurLeSite;
    }

    public function setTotalDepenseSurLeSite(?float $totalDepenseSurLeSite): self
    {
        $this->totalDepenseSurLeSite = $totalDepenseSurLeSite;

        return $this;
    }

    public function getEtatDeLaCommande(): ?string
    {
        return $this->etatDeLaCommande;
    }

    public function setEtatDeLaCommande(string $etatDeLaCommande): self
    {
        $this->etatDeLaCommande = $etatDeLaCommande;

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setCommandes($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getCommandes() === $this) {
                $adress->setCommandes(null);
            }
        }

        return $this;
    }

    public function getMoyenPaiement(): ?MoyenPaiement
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(?MoyenPaiement $moyenPaiement): self
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }
}
