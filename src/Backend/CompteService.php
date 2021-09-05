<?php
namespace App\Backend;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Compte;
use App\Entity\Client;

class CompteService
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function ajouterCompte(Compte $compte) : void
    {
        $this->em->persist($compte);
        $this->em->flush();
    }
    
    public function modifierCompte(Compte $compte) : void
    {
        $this->em->merge($compte);
        $this->em->flush();
    }
    
    
    public function supprimerCompte(int $numero) : void 
    {
        $compte = $this->em->getRepository('App:Compte')->find($numero);
        $this->em->remove($compte);
        $this->em->flush();
    }
    
    public function rechercherCompteParNumero(int $numero) : Compte
    {
        return $this->em->getRepository('App:Compte')->find($numero);
    }
    
    public function rechercherComptesClient(Client $client) : array 
    {
        $query = $this->em->createQuery('SELECT c FROM App:Compte c WHERE c.client=:client');
        $query->setParameter('client', $client);
        return $query->getResult();
    }
    
    public function rechercherComptesDebiteurs() : array 
    {
        $query = $this->em->createQuery-('SELECT c FROM App:Compte c WHERE c.solde < 0');
        return $query->getResult();
    }

}

