<?php

namespace App\Entity;

use App\Repository\AjoutsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AjoutsRepository::class)]
class Ajouts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $qte = null;

    #[ORM\ManyToOne(inversedBy: 'ajouts')]
    private ?Panier $panier = null;

    #[ORM\ManyToOne(inversedBy: 'ajouts')]
    private ?Webheberge $webheberge = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getPanier(): ?panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    public function getWebheberge(): ?webheberge
    {
        return $this->webheberge;
    }

    public function setWebheberge(?webheberge $webheberge): self
    {
        $this->webheberge = $webheberge;

        return $this;
    }
}
