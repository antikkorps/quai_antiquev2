<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlatRepository;

class PlatController extends AbstractController
{
    #[Route('/plat', name: 'app_plat')]
    public function index(PlatRepository $platRepository): Response
    {
        $plats = $platRepository->findAll();
        dd($plats);

        return $this->render('plat/index.html.twig', [
            'plats' => $plats,
        ]);
    }

    #[Route('/plat/add', name: 'app_add_plat')]
    public function addplat(EntityManagerInterface $em): Response
    {
        $plat = new Plat();
        $plat->setNom('Nom du plat');
        $plat->setDescription('Description du plat');
        $plat->setPrix('Prix du plat');
        $plat->setCategorieId('Categorie du plat');
        $plat->setPhoto('Photo du plat');
        $plat->setDisplayInGallery('Afficher dans la galerie');
        
        $em->persist($plat);
        $em->flush();

        die();
        return $this->render('plat/add.html.twig');
    }

    #[Route('/plat/{id}', name: 'app_show_plat')]
    public function showPlat(int $id, PlatRepository $platRepository): Response
    {
        $plat = $platRepository->find($id);
        dd($plat);

        return $this->render('plat/show.html.twig', [
            'plat' => $plat,
        ]);
    }
}
