<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response

    {
        $data = new ContactDTO();

        //TODO : Supp
        $data->name = 'Hadil';
        $data->email = 'hamdihadil51@gmail.com';
        $data->message = 'Super site';



        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $mail = ( new TemplatedEmail())
            ->to( 'contact@demo.fr')
            ->from($data->email)
            ->subject('Demande de contact')
            ->htmlTemplate('emails/contact.html.twig')
            ->context(['data' => $data]);
            $mailer->send($mail);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            $this->redirectToRoute('contact'); 

        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
