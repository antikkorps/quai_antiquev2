<?php

namespace App\Components;

use App\Repository\HoraireRepository;
use App\Repository\ReservationRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;


#[AsTwigComponent('places_restantes')]
class PlacesRestantes
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
        //calculer le nombre de place restantes en faisant (la capacité du matin + la capacité du soir) - le nombre de réservations
        $capaciteglobale = $horaire->getCapaciteMatin() + $horaire->getCapaciteSoir();
        $reservations = $this->reservationRepository->findBy(['horaireDeVenue' => $horaire]);
        $nombreDePersonnes = 0;
        foreach ($reservations as $reservation) {
            $nombreDePersonnes += $reservation->getNombreDePersonnes();
        }
        $placesRestantes = $capaciteglobale - $nombreDePersonnes;

        return $placesRestantes;
    }
    public function getHoraires(): array
    {
        return $this->horaireRepository->findAll();
    }
}
