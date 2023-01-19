<?php

namespace App\Components;

use App\Repository\HoraireRepository;
use App\Repository\ReservationRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('places_restantes')]
class PlaceRestantes
{
    public HoraireRepository $horaireRepository;
    public ReservationRepository $reservationRepository;

    public function __construct(HoraireRepository $horaireRepository, ReservationRepository $reservationRepository)
    {
        $this->horaireRepository = $horaireRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function getPlacesRestantes($horaire): int
    {
        $placesRestantes = 100;
        $reservations = $this->reservationRepository->findBy(['horaireDeVenue' => $horaire]);
        foreach ($reservations as $reservation) {
            $placesRestantes -= $reservation->getNombreDePersonnes();
        }
        return $placesRestantes;
    }
    public function getHoraires(): array
    {
        return $this->horaireRepository->findAll();
    }
}
