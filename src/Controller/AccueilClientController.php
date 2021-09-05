<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Backend\ClientService;

class AccueilClientController extends AbstractController
{
    /**
     * @Route("/accueil-client", name="accueil_client")
     */
    public function index(ClientService $clientService): Response
    {
        
        $client = $clientService->rechercherClientParId(1);
        
        dump($client);
        
        
        return $this->render('accueil_client/index.html.twig', [
            'controller_name' => 'AccueilClientController',
        ]);
    }
}
