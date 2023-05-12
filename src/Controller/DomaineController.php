<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DomaineController extends AbstractController
{
    #[Route('/domaine', name: 'app_domaine')]
    public function index(): Response
    {
        return $this->render('domaine/index.html.twig', [
            'controller_name' => 'DomaineController',
        ]);
    }
}
