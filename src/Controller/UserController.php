<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\User;
use App\Form\ListeUsersType;

class UserController extends AbstractController
{
    #[Route('/private-user', name: 'app_user')]
    public function index(EntityManagerInterface $emi, UserRepository $userRepository, SessionInterface $session): Response
    {
        $visitors = $session->get('visitors', 0);
        $session->set('visitors', ++$visitors);

        $count = $userRepository->count([]);
        $repoUser =  $emi->getRepository(User::class);
        $user = $repoUser->findAll(); 
        return $this->render('user/index.html.twig', [
            'user' => $user,
            'count' => $count,
            'visitors' => $visitors,
        ]);
    }
}
