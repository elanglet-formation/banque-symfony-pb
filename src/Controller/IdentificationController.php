<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\IdentificationForm;
use App\Business\BanqueBusiness;

class IdentificationController extends AbstractController
{
    /**
     * @Route("/identification", name="identification")
     */
    public function index(Request $request, BanqueBusiness $banqueBusiness): Response
    {
        try {
            $form = $this->createForm(IdentificationForm::class, null);
        
            $form->handleRequest($request);
            
            if($form->isSubmitted()) {
                $identifiant = $form->getData()['identifiant'];
                $motDePasse = $form->getData()['mot_de_passe'];
                
                $client = $banqueBusiness->authentifier($identifiant, $motDePasse);
                                
                $session = $this->get('session');
                $session->set('leClient', $client);
                
                return $this->forward('App\Controller\IndexController::index');
            }
            else {
                return $this->render(
                    'identification/index.html.twig', 
                    [
                        'message' => null,
                        'identificationForm' => $form->createView()    
                    ]
                );
            }
        }
        catch(\Exception $e) {
            return $this->render(
                'identification/index.html.twig',
                [
                    'identificationForm' => $form->createView(),
                    'message' => "Erreur d'authentification !"
                ]
            );
        }
    }
}
