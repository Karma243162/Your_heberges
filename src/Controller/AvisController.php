<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Avis;
use App\Form\AvisType;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'app_avis')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();

        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis); 
            $avis->setDate(new \Datetime());
            $entityManager->flush();
       
            $this->addFlash('success', 'Votre avis a été enregistré.');

            return $this->redirectToRoute('index');
        }
        return $this->render('avis/index.html.twig', [
            'form' => $form->createView(),
            'avis' => $avis,
        ]);
    }

    #[Route('/liste-avis', name: 'liste-avis')]  // /base est l’URL de la page, name est le nom de la route
    public function ListeAvis(EntityManagerInterface $emi): Response { 
    $repoUser =  $emi->getRepository(User::class);
    $user = $repoUser->findAll(); 
        return $this->render('base/index.html.twig', [ // render est la fonction qui va chercher le fichier TWIG pour l’afficher
            'user' => $user,
        ]);
    }
}
