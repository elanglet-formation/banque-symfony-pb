<?php

namespace App\Tests\Unit\Backend;

use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Backend\ClientService;
use App\Entity\Client;
use Doctrine\Persistence\ObjectRepository;

class ClientServiceTest extends TestCase
{
    // on declare l'objet à tester
    private $clientService;
    
    // On declere les mocks nécessaires
    // on declare un mock sur entityManagerInterface
    private $EntityManager;
    // on declare un mock sur objectRepository
    private $repo;

    public function setUp(): void
    {
        // Création des mocks
        $this->EntityManager = $this->createMock(EntityManagerInterface::class);
        $this->repo = $this->createMock(ObjectRepository::class);
        
        // on instancie l'objet à tester en lui passant le mock
        $this->clientService = new ClientService($this->EntityManager);
    }
    
    public function testRechercherClientParId(): void
    {
        // on crée 'objet que l'on s'attend a recevoir
        $client = new Client();
        $client->setId(1);
        
        // Comportement
        $this->EntityManager->expects($this->once())
                            ->method('getRepository')
                            ->with('App:Client')
                            ->willReturn($this->repo);
        
        $this->repo->expects($this->once())
                   ->method('find')
                   ->with(1)
                   ->willReturn($client);
        
        // Appelle la méthode a tester
        $returnedClient = $this->clientService->rechercherClientParId(1);
        
        // Assertion : on verifie que lobjet retourne est le meme que calui attendu
        $this->assertSame($client, $returnedClient);
        
    }
    
    public function testAjouterClient(): void
    {
        $client = new Client();
        
        // description du comportement attndu
        // 1 - on s'attend a avoir un et un seul appel a pesist
        // avec l'objet client en parametre
        $this->EntityManager->expects($this->once())        // un et un seul appel
             ->method('persist')                            // appel à persist
             ->with($client);                               // avec $client
        
         // 2 - on s'attend a avoir un et un seul appel a flush
         // avec l'objet client en parametre
        $this->EntityManager->expects($this->once())        // un et un seul appel
             ->method('flush');                             // appel à flush
        
         // On execute la méthode a tester
         $this->clientService->ajouterClient($client);
    }
}
