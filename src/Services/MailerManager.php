<?php

namespace App\Services;

use App\Entity\Buyer;
use App\Entity\Billet;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MailerManager {
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var \Twig_Environment
     */
    private $templating;

    /**
     * @Const Mail Musée du Louvre
     */
    private const mail = 'bastien.gauthier.dev@gmail.com';

    public function __construct(\Swift_Mailer $mailer, SessionInterface $session, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->session = $session;
        $this->templating = $templating;
    }

    public function receiptSend()
    {
        $buyer = $this->session->get('buyer');
        $billet = $this->session->get('billet');

        $subject = 'Musée du Louvre - Confirmation';
        $from = MailerManager::mail;
        $to = $buyer->getEmail();
        $body = $this->templating->render('email/email.html.twig', ['buyer' => $buyer, 'billet' => $billet]);
        $this->sendEmail($subject, $from, $to, $body);
    }

    public function sendEmail($subject, $from, $to, $body) {
        $message = (new \Swift_Message($subject))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body)
            ->setContentType('text/html');

        $mailer = $this->mailer->send($message);

        //return $this->render(...);
    }
}