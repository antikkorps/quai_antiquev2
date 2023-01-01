<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogOutController extends AbstractController
{
    #[Route('/logout', name: 'app_log_out')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'LogOutController',
        ]);
    }
}
