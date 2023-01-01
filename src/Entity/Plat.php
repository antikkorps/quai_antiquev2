<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::INTEGER, precision: 6, scale: 2)]
    private ?string $prix = null;

    #[ORM\ManyToOne(inversedBy: 'plats_par_categorie')]
    #[ORM\JoinColumn(nullable: true)]
    private ?CategorieDuPlat $categorie_id = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\ManyToMany(targetEntity: Formule::class, mappedBy: 'plat')]
    private Collection $formules;

    #[ORM\Column]
    private ?bool $display_in_gallery = null;

    public function __construct()
    {
        $this->formules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorieId(): ?CategorieDuPlat
    {
        return $this->categorie_id;
    }

    public function setCategorieId(?CategorieDuPlat $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Formule>
     */
    public function getFormules(): Collection
    {
        return $this->formules;
    }

    public function addFormule(Formule $formule): self
    {
        if (!$this->formules->contains($formule)) {
            $this->formules->add($formule);
            $formule->addPlat($this);
        }

        return $this;
    }

    public function removeFormule(Formule $formule): self
    {
        if ($this->formules->removeElement($formule)) {
            $formule->removePlat($this);
        }

        return $this;
    }

    public function isDisplayInGallery(): ?bool
    {
        return $this->display_in_gallery;
    }

    public function setDisplayInGallery(bool $display_in_gallery): self
    {
        $this->display_in_gallery = $display_in_gallery;

        return $this;
    }
}
