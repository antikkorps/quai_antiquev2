<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends AbstractController
{
    #[Route('/email', name: 'app_mailer')]
    public function sendEmail(MailerInterface $mailer): Response
    {

        $email = (new Email())
            ->from('contact@quai-antique.com')
            ->to('franckvienot7@gmail.com')
            ->subject('Suite à votre demande de réinitialisation de mot de passe')
            ->text('Bonjour, vous avez demandé à réinitialiser votre mot de passe. Pour ce faire, veuillez cliquer sur le lien suivant : http://localhost:8000/reset-password/');

        $mailer->send($email);

        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
    #[Route('/confirmation_de_reservation', name: 'app_confirmation_de_reservation')]
    public function confirmationDeReservation(MailerInterface $mailer, UserRepository $userRepository, Request $request): Response
    {
        //get the actual user mail
        $user = $userRepository->findOneByEmail($request->get('email'));

        $email = (new Email())
            ->from('contact@quai-antique.com')
            ->to('franckvienot7@gmail.com')
            ->subject('Confirmation de votre réservation')
            ->text('Bonjour, vous avez réservé une table au Quai Antique et nous vous en remercions. Nous vous attendons donc le ' . $request->get('date') . ' à ' . $request->get('heure') . ' pour un moment de convivialité et de partage. A très bientôt !');

        $mailer->send($email);

        return $this->render('mailer/confirmation_de_resa.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
