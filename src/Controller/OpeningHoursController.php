<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
// form à créer
use App\Repository\RushHourRepository;
use App\Entity\RushHour;

class OpeningHoursController extends AbstractController
{
    #[Route('/opening_hours', name: 'app_opening_hours')]
    public function index(RushHourRepository $rushHourRepository): Response
    {
        $hours = $rushHourRepository->findAll();

        return $this->render('opening_hours/index.html.twig', [
            'hours' => $hours,
        ]);
    }

    #[Route('/admin/opening_hours/add', name: 'app_add_opening_hours')]
    public function modify_opening_hours(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hours = new RushHour();
        
        $form = $this->createForm(Opening_hoursFormType::class, $hours);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $entityManager->persist($hours);
            $entityManager->flush();
            
        }
        return $this->render('opening_hours/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
