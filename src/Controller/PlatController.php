<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PlatFormType;
use App\Repository\PlatRepository;
use App\Entity\Plat;


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
    public function addplat(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plat = new Plat();
        
        $form = $this->createForm(PlatFormType::class, $plat);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $entityManager->persist($plat);
            $entityManager->flush();
            
        }
        return $this->render('plat/add.html.twig', [
            'form' => $form->createView(),
        ]);
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
