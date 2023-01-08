<?php

namespace App\Entity;

use App\Repository\RushHourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RushHourRepository::class)]
class RushHour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60, nullable: true)]
    private ?string $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $morning_opening_hour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $morning_closing_hour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $evening_opening_hour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $evening_closing_hour = null;

    #[ORM\Column (nullable:true)]
    private ?int $capacite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getMorningOpeningHour(): ?\DateTimeInterface
    {
        return $this->morning_opening_hour;
    }

    public function setMorningOpeningHour(?\DateTimeInterface $morning_opening_hour): self
    {
        $this->morning_opening_hour = $morning_opening_hour;

        return $this;
    }

    public function getMorningClosingHour(): ?\DateTimeInterface
    {
        return $this->morning_closing_hour;
    }

    public function setMorningClosingHour(?\DateTimeInterface $morning_closing_hour): self
    {
        $this->morning_closing_hour = $morning_closing_hour;

        return $this;
    }

    public function getEveningOpeningHour(): ?\DateTimeInterface
    {
        return $this->evening_opening_hour;
    }

    public function setEveningOpeningHour(?\DateTimeInterface $evening_opening_hour): self
    {
        $this->evening_opening_hour = $evening_opening_hour;

        return $this;
    }

    public function getEveningClosingHour(): ?\DateTimeInterface
    {
        return $this->evening_closing_hour;
    }

    public function setEveningClosingHour(?\DateTimeInterface $evening_closing_hour): self
    {
        $this->evening_closing_hour = $evening_closing_hour;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite = null): void
    {
        $this->capacite = $capacite;

    }
}
