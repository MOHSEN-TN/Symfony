<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
class SendmailController extends AbstractController
{
    #[Route('/sendmail', name: 'app_sendmail')]
    public function index(): Response
    {
        $user= $this->getUser();


        return $this->render('sendmail/index.html.twig', [
            'controller_name' => 'SendmailController',
        ]);
    }



}
