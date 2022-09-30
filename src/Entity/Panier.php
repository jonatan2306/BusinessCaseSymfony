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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $panierCode = null;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPanierCode(): ?string
    {
        return $this->panierCode;
    }

    public function setPanierCode(string $panierCode): self
    {
        $this->panierCode = $panierCode;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getPanierCode();
    }
}
