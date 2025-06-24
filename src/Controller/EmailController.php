<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

final class EmailController extends AbstractController
{
    #[Route('/email', name: 'app_email')]
    public function index(MailerInterface $mailer): Response
    {
        $email = new TemplatedEmail();
        $email->subject('Bienvenue sur Snowtricks')
              ->from('snowtricks@demomailtrap.co')
              ->to('caribnrocket@gmail.com')
              ->text('Nous sommes ravis de vous avoir sur Snowtricks !')
              ->htmlTemplate('email/welcome.html.twig');
        
        $mailer->send($email);
        
        return $this->render('email/index.html.twig', [
            'controller_name' => 'EmailController',
        ]);
    }
}
