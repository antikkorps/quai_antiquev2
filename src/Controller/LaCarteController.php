<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlatRepository;


class LaCarteController extends AbstractController
{
    #[Route('/la_carte', name: 'app_la_carte')]
    public function index(PlatRepository $platRepository): Response
    {
        $plats = $platRepository->findAll();
        $categories = [];
        foreach ($plats as $plat) {
            $categories[$plat->getCategoriePlat()][] = $plat;
        }

        return $this->render('la_carte/index.html.twig', [
            'plats' => $plat,
            'categories' => $categories,
        ]);
    }
}
