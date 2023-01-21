<?php

namespace App\Components;

use App\Entity\Reservation;
use App\Repository\HoraireRepository;
use App\Repository\ReservationRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsTwigComponent('places_restantes', template: 'components/places_restantes.html.twig')]
class PlacesRestantes extends AbstractController
{
    public function getPlacesRestantes(Request $request, PlacesRestantes $placesRestantes, HoraireRepository $horaireRepository, ReservationRepository $reservationRepository): Response
    {
        //on récupère la capacité en fonction du jour choisi par l'utilisateur dans le formulaire réservation
        $capacite = $horaireRepository->findOneBy(['jour' => $request->get('jour')])->getCapaciteMidi() + $horaireRepository->findOneBy(['jour' => $request->get('jour')])->getCapaciteSoir();
        //on récupère le nombre de réservations en fonction du jour choisi par l'utilisateur dans le formulaire réservation
        $nbReservations = $reservationRepository->findBy(['jour' => $request->get('jour')]);
        //on calcule le nombre de places restantes
        $placesRestantes = $capacite - count($nbReservations);
        //on retourne le nombre de places restantes
        dd($placesRestantes);
        return $this->render('components/places_restantes.html.twig', [
            'placesRestantes' => $placesRestantes,

        ]);
    }
}
