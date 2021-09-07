<?php

namespace App\Tests\Unit\Business;

use PHPUnit\Framework\TestCase;
use App\Entity\Client;
use App\Backend\ClientService;
use App\Backend\CompteService;
use App\Business\BanqueBusiness;

class BanqueBusinessTest extends TestCase
{
    private $banqueBusiness;
    private $client;
    
    public function setUp(): void
    {
        // On crée un STUB pour clientService
        // une implementation qui ne contient que la methode 'rechercheClientParId'
        // et qui renvoie toujours le meme objet client
        $this->client = new Client();
        $this->client->setId(1);
        $this->client->setMotdepasse('pbo');
        
        $clientService = $this->createMock(ClientService::class);
        // On définit la methode
        $clientService->method('rechercherClientParId')
                      ->willReturn($this->client);
        
        // On créé un STUB pour compteService
        $compteService = $this->createMock(CompteService::class);
        
        // On instancie lobjet à tester
        $this->banqueBusiness = new BanqueBusiness($clientService, $compteService);
    }
    
    public function testAuthentifier(): void
    {
        // on appelle la méhode à tester en cohérence avec ce que envoie le STUD
        $clientReturned = $this->banqueBusiness->authentifier(1, 'pbo');
        
        $this->assertNotNull($clientReturned);
        $this->assertSame($this->client, $clientReturned);
    }
    
    public function testAuthentifierEchec(): void
    {
        // on declare une exception de type \Exception va etre declenchée
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Erreur d'authentification.");
        
        // on appelle la méhode à tester en cohérence avec ce que envoie le STUD
        $clientReturned = $this->banqueBusiness->authentifier(1, 'bidon');
    }
}
