<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ouvertureMidi = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fermetureMidi = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ouvertureSoir = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fermetureSoir = null;

    #[ORM\Column(nullable: true)]
    private ?int $capaciteMidi = null;

    #[ORM\Column(nullable: true)]
    private ?int $capaciteSoir = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getOuvertureMidi(): ?\DateTimeInterface
    {
        return $this->ouvertureMidi;
    }

    public function setOuvertureMidi(?\DateTimeInterface $ouvertureMidi): self
    {
        $this->ouvertureMidi = $ouvertureMidi;

        return $this;
    }

    public function getFermetureMidi(): ?\DateTimeInterface
    {
        return $this->fermetureMidi;
    }

    public function setFermetureMidi(?\DateTimeInterface $fermetureMidi): self
    {
        $this->fermetureMidi = $fermetureMidi;

        return $this;
    }

    public function getOuvertureSoir(): ?\DateTimeInterface
    {
        return $this->ouvertureSoir;
    }

    public function setOuvertureSoir(?\DateTimeInterface $ouvertureSoir): self
    {
        $this->ouvertureSoir = $ouvertureSoir;

        return $this;
    }

    public function getFermetureSoir(): ?\DateTimeInterface
    {
        return $this->fermetureSoir;
    }

    public function setFermetureSoir(?\DateTimeInterface $fermetureSoir): self
    {
        $this->fermetureSoir = $fermetureSoir;

        return $this;
    }

    public function getCapaciteMidi(): ?int
    {
        return $this->capaciteMidi;
    }

    public function setCapaciteMidi(?int $capaciteMidi): self
    {
        $this->capaciteMidi = $capaciteMidi;

        return $this;
    }

    public function getCapaciteSoir(): ?int
    {
        return $this->capaciteSoir;
    }

    public function setCapaciteSoir(?int $capaciteSoir): self
    {
        $this->capaciteSoir = $capaciteSoir;

        return $this;
    }
}
