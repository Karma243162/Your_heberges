<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vps;
use App\Form\AjoutVpsType;
use App\Form\ModfifVpsLinuxType;

class VpsController extends AbstractController
{
    #[Route('/vps-linux', name: 'app_vps_linux')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $repoVps = $entityManagerInterface->getRepository(Vps::class);
        $vps = $repoVps->findAll(); 
        return $this->render('vps/linux.html.twig', [
            'vps' => $vps,
        ]);
    }

    #[Route('/private-gestion-vps', name: 'gestion-vps')]
    public function GestionVps(EntityManagerInterface $entityManagerInterface): Response
    {
      
        return $this->render('vps/gestion/index.html.twig', [
 
        ]);
    }

    #[Route('/private-gestion-vps-linux', name: 'gestion-vps-linux')]
    public function GestionVpsLinux(EntityManagerInterface $entityManagerInterface): Response
    {
        $repoVpsLinux = $entityManagerInterface->getRepository(Vps::class);
        $vpsLinux = $repoVpsLinux->findAll(); 
        return $this->render('vps/gestion/vps-linux.html.twig', [
            'vpsLinux' => $vpsLinux,
        ]);
    }

    #[Route('/gestion-vps-modif{id}', name: 'gestion-vps-modif')] // étape 1
    public function catModif(Request $request,EntityManagerInterface $entityManagerInterface): Response // étape 2
    {
        $id = $request -> get('id'); 
        $repoVpsLinux = $entityManagerInterface->getRepository(Vps::class);
        $VpsLinux = $repoVpsLinux->find($id);
        $form = $this->createForm(ModfifVpsLinuxType::class, $VpsLinux);
        if($request->isMethod('POST')){
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $entityManagerInterface->persist($VpsLinux); 
            $entityManagerInterface->flush(); 
            $this->addFlash('notice','Modification validé');
            return $this->redirectToRoute('gestion-vps-linux'); 
        }
        }
        return $this->render('vps/gestion/modif/vps-linux.html.twig', [
            'modif' => $VpsLinux, 
            'form' => $form->createView()
            
            
        ]);
        
    }

    #[Route('/private-supp-vps/{id}', name: 'suppVps')]
    public function SuppVps(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $id = $request->get('id');
        $repoVpsLinux = $entityManagerInterface->getRepository(Vps::class);
        $VpsLinux = $repoVpsLinux->find($id);
        
        
        $entityManagerInterface->remove($VpsLinux);
        $entityManagerInterface->flush();

        $this->addFlash('notice','Produit supprimé');
        return $this->redirectToRoute('gestion-vps-linux');
            
        

    }

    #[Route('/Ajout-Vps', name: 'Ajout-Vps')] // étape 1
    public function AjoutVps(Request $request,EntityManagerInterface $entityManagerInterface): Response // étape 2
    {
          $VpsLinux = new Vps();

      $form = $this->createForm(AjoutVpsType::class, $VpsLinux);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $entityManagerInterface->persist($VpsLinux);
          $entityManagerInterface->flush();
            return $this->redirectToRoute('gestion-vps-linux'); 
        }
        
        return $this->render('hebergement/gestion/add/web.html.twig', [
            'form' => $form->createView()   
        ]);
        
    }
}
