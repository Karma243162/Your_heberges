<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class BaseController extends AbstractController
{
    #[Route('/index', name: 'index')]  // /base est l’URL de la page, name est le nom de la route
    public function index(EntityManagerInterface $emi): Response { 
    $repoUser =  $emi->getRepository(User::class);
    $user = $repoUser->findAll(); 
        return $this->render('base/index.html.twig', [ // render est la fonction qui va chercher le fichier TWIG pour l’afficher
            'user' => $user,
        ]);
    }
}
      