<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\MetaData\ApiResource;
use ApiPlatform\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;


#[ApiResource()]

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: Ajouts::class)]
    private Collection $ajouts;

    public function __construct()
    {
        $this->ajouts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $ajout->setPanier($this);
        }

        return $this;
    }

    public function removeAjout(Ajouts $ajout): self
    {
        if ($this->ajouts->removeElement($ajout)) {
            // set the owning side to null (unless already changed)
            if ($ajout->getPanier() === $this) {
                $ajout->setPanier(null);
            }
        }

        return $this;
    }
}
