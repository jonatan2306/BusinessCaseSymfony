<?php

namespace App\Entity;

use App\Repository\VisitorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisitorRepository::class)]
class Visitor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $addr_ip = null;

    #[ORM\Column]
    private ?bool $isVisited = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddrIp(): ?string
    {
        return $this->addr_ip;
    }

    public function setAddrIp(string $addr_ip): self
    {
        $this->addr_ip = $addr_ip;

        return $this;
    }

    public function isIsVisited(): ?bool
    {
        return $this->isVisited;
    }

    public function setIsVisited(bool $isVisited): self
    {
        $this->isVisited = $isVisited;

        return $this;
    }
}
