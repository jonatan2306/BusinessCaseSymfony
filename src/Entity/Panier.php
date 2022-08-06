<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $delaiLivraison = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nombreProduit = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixPanier = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixProduit = null;

    #[ORM\ManyToMany(targetEntity: Produits::class, inversedBy: 'paniers')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelaiLivraison(): ?string
    {
        return $this->delaiLivraison;
    }

    public function setDelaiLivraison(?string $delaiLivraison): self
    {
        $this->delaiLivraison = $delaiLivraison;

        return $this;
    }

    public function getNombreProduit(): ?string
    {
        return $this->nombreProduit;
    }

    public function setNombreProduit(?string $nombreProduit): self
    {
        $this->nombreProduit = $nombreProduit;

        return $this;
    }

    public function getPrixPanier(): ?float
    {
        return $this->prixPanier;
    }

    public function setPrixPanier(?float $prixPanier): self
    {
        $this->prixPanier = $prixPanier;

        return $this;
    }

    public function getPrixProduit(): ?float
    {
        return $this->prixProduit;
    }

    public function setPrixProduit(?float $prixProduit): self
    {
        $this->prixProduit = $prixProduit;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        $this->produits->removeElement($produit);

        return $this;
    }
}
