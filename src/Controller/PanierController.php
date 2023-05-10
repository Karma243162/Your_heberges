<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Webheberge;
use App\Entity\Article;
use App\Entity\User;
use App\Entity\Ajouts;
use App\Entity\Panier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends AbstractController
{

    #[Route('/profile-liste-panier/', name: 'listepanier')]
    public function ListePanier(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $repowebheberge = $entityManagerInterface->getRepository(Webheberge::class);
        $webheberge = $repowebheberge->findAll();
        
        return $this->render('panier/index.html.twig', [
            'webheberges' => $webheberge,
        ]);

    }

    #[Route('/ajout-panier{id}', name: 'ajoutPanier')]
    public function panier(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $id = $request->get('id');
        $page = $request ->get('page');
        if ($this->getUser()->getPanier()==null) {
            $panier= new Panier();
            $this->getUser()->setPanier($panier);
        }
        $ajouts = new Ajouts();
        $ajouts->setQte(1);
        $webheberge = $entityManagerInterface->getRepository(Webheberge::Class)->find($id);
        if ($webheberge!=null) {
            $ajouts -> setWebheberge($webheberge); 
            $ajouts->setPanier($this->getUser()->getPanier());
            $entityManagerInterface->persist($this -> getUser()); 
            $entityManagerInterface->persist($ajouts); 
            $entityManagerInterface->flush(); 
        }

        return $this->redirectToRoute($page, [
            'webheberges' => $webheberge,
            'ajouts' => $ajouts,
        ]);
             
      return $this->redirectToRoute($page);
    
    } 
}
