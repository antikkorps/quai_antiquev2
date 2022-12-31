<?php

namespace App\Entity;

use App\Repository\CategorieDuPlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieDuPlatRepository::class)]
class CategorieDuPlat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nom_categorie = null;

    #[ORM\OneToMany(mappedBy: 'categorie_id', targetEntity: Plat::class, orphanRemoval: true)]
    private Collection $plats_par_categorie;

    public function __construct()
    {
        $this->plats_par_categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nom_categorie;
    }

    public function setNomCategorie(string $nom_categorie): self
    {
        $this->nom_categorie = $nom_categorie;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlatsParCategorie(): Collection
    {
        return $this->plats_par_categorie;
    }

    public function addPlatsParCategorie(Plat $platsParCategorie): self
    {
        if (!$this->plats_par_categorie->contains($platsParCategorie)) {
            $this->plats_par_categorie->add($platsParCategorie);
            $platsParCategorie->setCategorieId($this);
        }

        return $this;
    }

    public function removePlatsParCategorie(Plat $platsParCategorie): self
    {
        if ($this->plats_par_categorie->removeElement($platsParCategorie)) {
            // set the owning side to null (unless already changed)
            if ($platsParCategorie->getCategorieId() === $this) {
                $platsParCategorie->setCategorieId(null);
            }
        }

        return $this;
    }
}
