<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\ListeUsersType;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(EntityManagerInterface $emi): Response
    {
        $repoUser =  $emi->getRepository(User::class);
        $user = $repoUser->findAll(); 
        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
