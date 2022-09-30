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
    private ?string $nombreProduit = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixPanier = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;
    

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
