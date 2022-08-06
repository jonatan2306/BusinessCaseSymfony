<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Commune = null;

    #[ORM\Column(nullable: true)]
    private ?string $CodePostale = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $Pays = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    private ?Commandes $commandes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommune(): ?string
    {
        return $this->Commune;
    }

    public function setCommune(?string $Commune): self
    {
        $this->Commune = $Commune;

        return $this;
    }

    public function getCodePostale(): ?string
    {
        return $this->CodePostale;
    }

    public function setCodePostale(?string $CodePostale): self
    {
        $this->CodePostale = $CodePostale;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(?string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getCommandes(): ?Commandes
    {
        return $this->commandes;
    }

    public function setCommandes(?Commandes $commandes): self
    {
        $this->commandes = $commandes;

        return $this;
    }
}
