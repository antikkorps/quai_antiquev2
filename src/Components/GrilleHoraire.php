<?php

namespace App\Components;

use App\Repository\HoraireRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('grille_horaires')]
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