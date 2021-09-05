<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Business\BanqueBusiness;

class ComptesController extends AbstractController
{
    /**
     * @Route("/comptes", name="comptes")
     */
    public function index(BanqueBusiness $banqueBusiness): Response
    {
        $session = $this->get('session');
        $client = $session->get('leClient');
        
        $listeDesComptes = $banqueBusiness->mesComptes($client->getId());
        
        return $this->render(
            'comptes/index.html.twig', 
            [
                'liste_des_comptes' => $listeDesComptes
            ]
        );
    }
}
