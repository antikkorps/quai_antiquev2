<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieDuPlatRepository;
use App\Entity\CategorieDuPlat;
use Doctrine\ORM\EntityManagerInterface;

class CategorieController extends AbstractController
{
    #[Route('/categories', name: 'app_categorie')]
    public function index(CategorieDuPlatRepository $CategorieDuPlatRepository): Response
    {
        $categories = $articleRepository->findAll();
        dd($categories);

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    #[Route('/categorie/add', name: 'app_add_categorie')]
    public function addCategorie(EntityManagerInterface $em): Response
    {
        $categorie = new CategorieDuPlat();
        $categorie->setNomCategorie('Nom de la catégorie');
        
        $em->persist($categorie);
        $em->flush();

        die();
        return $this->render('categorie/add.html.twig');
    }

    #[Route('/categorie/{id}', name: 'app_show_categorie')]
    public function showArticle(int $id, CategorieDuPlatRepository $CategorieDuPlatRepository): Response
    {
        $categorie = $CategorieDuPlatRepository->find($id);
        dd($categorie);

        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }
}
