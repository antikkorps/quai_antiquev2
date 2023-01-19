<?php

namespace App\Components;

use App\Repository\HoraireRepository;
use App\Repository\ReservationRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('places_restantes')]
class GrilleHoraire
{
    public HoraireRepository $horaireRepository;

    public function __construct(HoraireRepository $horaireRepository)
    {
        $this->horaireRepository = $horaireRepository;
    }
    public function getHoraires(): array
    {
        return $this->horaireRepository->findAll();
    }
}
