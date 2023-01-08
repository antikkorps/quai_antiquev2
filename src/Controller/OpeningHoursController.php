<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\RushHourRepository;
use App\Entity\RushHour;
use App\Form\OpeningHoursFormType;

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

    #[Route('/admin/opening_hours/edit/{id}', name: 'app_opening_hours_edit')]
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $rushHour = $entityManager->getRepository(RushHour::class)->find($id);

        $form = $this->createForm(OpeningHoursFormType::class, $rushHour);
      

        if (!$rushHour) {
            throw $this->createNotFoundException(
                'Pas d\'entrée pour cet id '.$id
            );
        }
        $entityManager->persist($rushHour);
        $entityManager->flush();

    return 
    $this->render('opening_hours/edit.html.twig', [
        'rushHour' => $rushHour,
    ]);
    }
}
