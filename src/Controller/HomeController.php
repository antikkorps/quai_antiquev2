<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlatRepository;
use App\Entity\Plat;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }
    // display displayOnHomepage() in home/galerie.html.twig
    public function displayOnHomepage(PlatRepository $platRepository): Response
    {
        $plats = $platRepository->findBy(['displayOnHomepage' => true]);

        return $this->render('home/galerie.html.twig', [
            'plats' => $plats,
        ]);
    }
}
