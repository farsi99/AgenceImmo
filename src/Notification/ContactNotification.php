<?php 

namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;


class ContactNotification
{
    /**
     * @var Environment $render
     */
    private $mailer;

    /**
     * @var Environment $render
     */
    private $render;

    public function __construct(\Swift_Mailer $mailer, Environment $render)
    {
        $this->mailer = $mailer;
        $this->render = $render;

    }
    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Agence: ' . $contact->getProperty()->getTitle()))
            ->setFrom('noreplay@agence.Fr')
            ->setTo('soule.farouk@aef.info')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->render->render('emails/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }

}