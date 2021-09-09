<?php

namespace App\Tests\Integration\Backend;

use App\Entity\Client;

class ClientServiceTest extends AbstractServiceTest
{    
    public function testRechercherClientParId(): void
    {
        // On créé l'objet client de reference
        $client = new Client();
        $client->setId(1);
        $client->setNom('DUPONT');
        $client->setPrenom('Robert');
        $client->setAdresse('40, rue de la Paix');
        $client->setCodepostal('75007');
        $client->setVille('Paris');
        $client->setMotdepasse('secret');
        
        // On appelle la méthode à tester
        $clientRecupere = $this->clientService->rechercherClientParId(1);
        
        // On compare l'objet récupere avec l'objet de reference
        $this->assertEquals($client, $clientRecupere);
    }
    
    public function testRechercherTousLesClients(): void
    {
        // On fixe le nombre d'enregistrement
        $nbEnreg = 2;
        
        // On appelle la méthode à tester
        $nbEnregRecupere = $this->clientService->rechercherTousLesClients();
        
        // On compare le nb attendu et le nombre récupéré
        $this->assertCount($nbEnreg, $nbEnregRecupere);
        
    }
    
    public function testAjouterClient(): void
    {
        // On créé l'objet client de reference à ajouter
        $client = new Client();
        $client->setId(3);
        $client->setNom('BONNEAU');
        $client->setPrenom('Jean');
        $client->setAdresse('5, rue du cochon');
        $client->setCodepostal('35137');
        $client->setVille('Bédée');
        $client->setMotdepasse('secret');
        
        // On appelle la méthode à tester
        $this->clientService->ajouterClient($client);
        $clientRecupere = $this->clientService->rechercherClientParId(3);
        
        // On compare l'objet récupere avec l'objet de reference
        $this->assertEquals($client, $clientRecupere);
        
        
    }
}
