<?php

namespace App\Entity;

use App\Repository\VpsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VpsRepository::class)]
class Vps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $processeur = null;

    #[ORM\Column]
    private ?int $stockage = null;

    #[ORM\Column(length: 255)]
    private ?string $ram = null;

    #[ORM\Column(length: 255)]
    private ?string $ip = null;

    #[ORM\Column]
    private ?int $bande_passante = null;

    #[ORM\Column(length: 255)]
    private ?string $localisation = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

   

    #[ORM\Column]
    private ?float $prix = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProcesseur(): ?string
    {
        return $this->processeur;
    }

    public function setProcesseur(string $processeur): self
    {
        $this->processeur = $processeur;

        return $this;
    }

    public function getStockage(): ?int
    {
        return $this->stockage;
    }

    public function setStockage(int $stockage): self
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getBandePassante(): ?int
    {
        return $this->bande_passante;
    }

    public function setBandePassante(int $bande_passante): self
    {
        $this->bande_passante = $bande_passante;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

 

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
