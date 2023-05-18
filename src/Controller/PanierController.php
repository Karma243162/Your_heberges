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
        $this->addFlash('notice','Article dans le panier');
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

    #[Route('/supp-panier', name: 'suppPanier')]
    public function supppanier(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        
        $webheberge = $entityManagerInterface->getRepository(Ajouts::class);
        $panier = $webheberge->findAll();
        foreach($panier as $e)
        {
            $entityManagerInterface->remove($e); 
        }

        
        $entityManagerInterface->flush();
        return $this->redirectToRoute("listepanier");

    }

    #[Route('/ajout-qte', name: 'ajoutQte')]
    public function ajoutqte(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $id = $request->get('id');
        $webheberge = $entityManagerInterface->getRepository(Ajouts::class);
        $panier = $webheberge->find($id);
        $qte =$panier->getQte();
        $panier->setQte($qte+1);
        $entityManagerInterface->persist($panier);
        $entityManagerInterface->flush();
        return $this->redirectToRoute("listepanier");

    }

    #[Route('/moins-qte', name: 'moinsQte')]
    public function moinsqte(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $id = $request->get('id');
        $webheberge = $entityManagerInterface->getRepository(Ajouts::class);
        $panier = $webheberge->find($id);
        $qte =$panier->getQte();
        if ($qte>1) {
            $panier->setQte($qte-1);
        }
        $entityManagerInterface->persist($panier);
        $entityManagerInterface->flush();
        return $this->redirectToRoute("listepanier");

    }

    #[Route('/supp-article-panier', name: 'suppArticlePanier')]
    public function suppunarticle(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $id = $request->get('id');
        $webheberge = $entityManagerInterface->getRepository(Webheberge::class);
        $panier = $webheberge->find($id);
        $entityManagerInterface->remove($panier); 
        $entityManagerInterface->flush();
        return $this->redirectToRoute("listepanier");

    }
}
