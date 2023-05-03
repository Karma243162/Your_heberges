<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebController extends AbstractController
{
    #[Route('/web-hebergement', name: 'web-hebergement')]
    public function web(): Response
    {
        return $this->render('hebergement/web.html.twig', [
            'controller_name' => 'WebController',
        ]);
    }

    #[Route('/clous-hebergement', name: 'cloud-hebergement')]
    public function cloud(): Response
    {
        return $this->render('hebergement/cloud.html.twig', [
            'controller_name' => 'WebController',
        ]);
    }

    #[Route('/wordpress-hebergement', name: 'wordpress-hebergement')]
    public function wordpress(): Response
    {
        return $this->render('hebergement/wordpress.html.twig', [
            'controller_name' => 'WebController',
        ]);
    }
}
