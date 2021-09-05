<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeconnexionController extends AbstractController
{
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function index(): Response
    {
        $session = $this->get('session');
        $session->remove('leClient');
        
        return $this->forward('App\Controller\IndexController::index');
    }
}
