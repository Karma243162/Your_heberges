<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Webheberge;
use App\Form\ModifWebHebergeType;
use App\Form\AjoutWebType;

class WebController extends AbstractController
{

                /*     PAGE HEBERGEMENT  */
    #[Route('/web-hebergement', name: 'web-hebergement')]
    public function web(EntityManagerInterface $entityManagerInterface): Response
    {

        $repoWebHeberge = $entityManagerInterface->getRepository(Webheberge::class);
        $webHeberge = $repoWebHeberge->findAll(); 
        return $this->render('hebergement/web.html.twig', [
            'webHeberge' => $webHeberge,
        ]);
    }


    #[Route('/cloud-hebergement', name: 'cloud-hebergement')]
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



      /*     PAGE Gestion HEBERGEMENT  */

      #[Route('/gestion-hebergement', name: 'gestion-hebergement')]
      public function GestionHebergement(EntityManagerInterface $entityManagerInterface, Request $request): Response
      {
  
          $repoWebHeberge = $entityManagerInterface->getRepository(Webheberge::class);
          $webHeberge = $repoWebHeberge->findAll(); 
          return $this->render('hebergement/gestion/gestion.html.twig', [
            'controller_name' => 'WebController',
          ]);
      }



      /*     PAGE Gestion web HEBERGEMENT  */

      #[Route('/gestion-web-hebergement', name: 'gestion-web-hebergement')]
      public function GestionWeb(EntityManagerInterface $entityManagerInterface, Request $request): Response
      {
        $id = $request->get('id');
        $action = $request->get('action'); 
          $repoWebHeberge = $entityManagerInterface->getRepository(Webheberge::class);
          $webHeberge = $repoWebHeberge->findAll(); 
          if ($action == 'remove') {
            $this->getUser()->removeFav($webHeberge);
        } 
          return $this->render('hebergement/gestion/gestion-web.html.twig', [
            'webHeberge' => $webHeberge,
          ]);
      }

      #[Route('/gestion-web-modif{id}', name: 'gestion-web-modif')] // étape 1
      public function catModif(Request $request,EntityManagerInterface $entityManagerInterface): Response // étape 2
      {
          $id = $request -> get('id'); 
          $repoWebHeberge = $entityManagerInterface->getRepository(Webheberge::class);
          $typewebHeberge = $repoWebHeberge->find($id);
          $form = $this->createForm(ModifWebHebergeType::class, $typewebHeberge);
          if($request->isMethod('POST')){
          $form->handleRequest($request);
          if ($form->isSubmitted()&&$form->isValid()) {
              $entityManagerInterface->persist($typewebHeberge); 
              $entityManagerInterface->flush(); 
              $this->addFlash('notice','Modification validé');
              return $this->redirectToRoute('gestion-web-hebergement'); 
          }
          }
          return $this->render('hebergement/gestion/modif/web.html.twig', [
              'modif' => $typewebHeberge, 
              'form' => $form->createView()
              
              
          ]);
          
      }


      #[Route('/Ajout-web', name: 'Ajout-web')] // étape 1
      public function AjoutWeb(Request $request,EntityManagerInterface $entityManagerInterface): Response // étape 2
      {
            $webHeberge = new Webheberge();

        $form = $this->createForm(AjoutWebType::class, $webHeberge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($webHeberge);
            $entityManagerInterface->flush();
              return $this->redirectToRoute('gestion-web-hebergement'); 
          }
          
          return $this->render('hebergement/gestion/add/web.html.twig', [
              'form' => $form->createView()   
          ]);
          
      }



    #[Route('/private-supp-web/{id}', name: 'suppWeb')]
    public function suppCat(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $id = $request->get('id');
        $repoWebHeberge = $entityManagerInterface->getRepository(Webheberge::class);
        $typewebHeberge = $repoWebHeberge->find($id);
        
        
        $entityManagerInterface->remove($typewebHeberge);
        $entityManagerInterface->flush();

        $this->addFlash('notice','Produit supprimé');
        return $this->redirectToRoute('web-hebergement');
            
        

    }


         /***********************************************************************/
}
