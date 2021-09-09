<?php

namespace App\Tests\Integration\Backend;

use App\Entity\Compte;

class CompteServiceTest extends AbstractServiceTest
{     
    public function testRechercherCompteParNumero(): void
    {        
        $compte = new Compte();
        $compte->setNumero(78954263);
        $compte->setSolde('5000.00');
        $compte->setClient($this->client);
        
        // On appelle la méthode à tester
        $compteRecupere = $this->compteService->RechercherCompteParNumero(78954263);
        
        // On compare l'objet récupere avec l'objet de reference
        $this->assertEquals($compte, $compteRecupere);
        
    }
    
    public function testRechercherCompteClient(): void
    {        
        // On appelle la méthode à tester
        $comptesRecupere = $this->compteService->rechercherComptesClient($this->client);
        
        // On compare l'objet récupere avec l'objet de reference
        foreach ($comptesRecupere as $compte)
        {
            $this->assertEquals($this->client, $compte->getClient());
        }
        
        $this->assertCount(2, $comptesRecupere);      
    }
    
    public function testAjouterCompte(): void
    {
        // On créé l'objet client de reference à ajouter
        $compte = new Compte();
        $compte->setNumero(22222222);
        $compte->setSolde('1000.00');
        $compte->setClient($this->client);
        
        // On appelle la méthode à tester
        $this->compteService->ajouterCompte($compte);
        $compteRecupere = $this->compteService->rechercherCompteParNumero(22222222);
        
        // On compare l'objet récupere avec l'objet de reference
        $this->assertEquals($compte, $compteRecupere);
           
    }
}
