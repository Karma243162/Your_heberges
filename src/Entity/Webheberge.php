<?php

namespace App\Entity;

use App\Repository\WebhebergeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebhebergeRepository::class)]
class Webheberge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $trafic = null;

    #[ORM\Column]
    private ?int $stockage = null;

    #[ORM\Column]
    private ?int $sous_domaine = null;

    #[ORM\Column]
    private ?int $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $ftp = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $processeur = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\OneToMany(mappedBy: 'webheberge', targetEntity: Ajouts::class)]
    private Collection $ajouts;

    public function __construct()
    {
        $this->ajouts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrafic(): ?string
    {
        return $this->trafic;
    }

    public function setTrafic(string $trafic): self
    {
        $this->trafic = $trafic;

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

    public function getSousDomaine(): ?int
    {
        return $this->sous_domaine;
    }

    public function setSousDomaine(int $sous_domaine): self
    {
        $this->sous_domaine = $sous_domaine;

        return $this;
    }

    public function getMail(): ?int
    {
        return $this->mail;
    }

    public function setMail(int $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getFtp(): ?string
    {
        return $this->ftp;
    }

    public function setFtp(string $ftp): self
    {
        $this->ftp = $ftp;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, Ajouts>
     */
    public function getAjouts(): Collection
    {
        return $this->ajouts;
    }

    public function addAjout(Ajouts $ajout): self
    {
        if (!$this->ajouts->contains($ajout)) {
            $this->ajouts->add($ajout);
            $ajout->setWebheberge($this);
        }

        return $this;
    }

    public function removeAjout(Ajouts $ajout): self
    {
        if ($this->ajouts->removeElement($ajout)) {
            // set the owning side to null (unless already changed)
            if ($ajout->getWebheberge() === $this) {
                $ajout->setWebheberge(null);
            }
        }

        return $this;
    }


    
}