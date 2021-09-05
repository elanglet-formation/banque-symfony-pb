<?php
namespace App\Backend;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

class ClientService
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function ajouterClient(Client $client) : void 
    {
        $this->em->persist($client);
        $this->em->flush();
    }
    
    public function modifierClient(Client $client) : void
    {
        $this->em->merge($client);
        $this->em->flush();
    }
    
    public function supprimerClient(int $id) : void
    {
        $client = $this->em->getRepository('App:Client')->find($id);
        $this->em->remove($client);
        $this->em->flush();
    }
    
    public function rechercherTousLesClients() : array 
    {
        return $this->em->getRepository('App:Client')->findAll();
    }
    
    public function rechercherClientParId(int $id) : Client
    {
        return $this->em->getRepository('App:Client')->find($id);
    }
    
    public function rechercherClientsParNomEtPrenom(string $nom, string $prenom) : array 
    {
        $query = $this->em->getRepository('App:Client')->createQuery('SELECT a FROM App:Client a WHERE a.nom=:nom AND a.prenom=:prenom');
        $query->setParameter(':nom', $nom);
        $query->setParameter(':prenom', $prenom);
        
        return $query->getResult();
    }
}

