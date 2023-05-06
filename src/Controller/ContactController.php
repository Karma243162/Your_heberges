<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController

{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer, EntityManagerInterface $emi): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){   
                $email = (new TemplatedEmail())
                ->from($form->get('email')->getData())
                ->from($contact->getEmail())
                ->to('mohammed.tahri24@gmail.com')
                ->subject($contact->getSujet())
                ->subject($form->get('sujet')->getData())
                ->htmlTemplate('emails/email.html.twig')
                ->context([
                    'nom'=> $contact->getNom(),
                    'sujet'=> $contact->getSujet(),
                    'message'=> $contact->getMessage()
                ]);
                $contact->setDateEnvoie(new \Datetime());
                $emi->persist($contact); 
                $emi->flush();
              
                $mailer->send($email);
                $this->addFlash('notice','Message envoyé');
                return $this->redirectToRoute('contact');
            }
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    } 


    #[Route('/private-liste-contacts', name: 'liste-contacts')]  // /base est l’URL de la page, name est le nom de la route
    public function index( EntityManagerInterface $emi): Response
    {
        $repoContact = $emi->getRepository(Contact::class);
        $contacts = $repoContact->findAll();
        return $this->render('contact/liste-contact.html.twig', [ // render est la fonction qui va chercher le fichier TWIG pour l’afficher
            'contacts' => $contacts
        ]);
    }

    #[Route('/private-supp-contact/{id}', name: 'suppContact')]
    public function suppCat(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $id = $request->get('id');
        $repoContact = $entityManagerInterface->getRepository(Contact::class);
        $contactDelete = $repoContact->find($id);
        
        
        $entityManagerInterface->remove($contactDelete);
        $entityManagerInterface->flush();

        $this->addFlash('notice','Contact supprimé');
        return $this->redirectToRoute('liste-contacts');
            
        

    }
}
