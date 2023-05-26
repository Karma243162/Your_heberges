<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Avis;
use Doctrine\ORM\EntityManagerInterface;

class StatistiqueController extends AbstractController
{
    #[Route('/statistique', name: 'app_statistique')]
    public function index(EntityManagerInterface $emi,): Response
    {
        $repoUser =  $emi->getRepository(User::class);
        $user = $repoUser->findAll();
        $repoAvis = $emi -> getRepository(Avis::class); 
        $avis = $repoAvis->findAll(); 
        return $this->render('statistique/index.html.twig', [
            'controller_name' => 'StatistiqueController',
            'user' => $user,
            'avis' => $avis
        ]);
    }
}
