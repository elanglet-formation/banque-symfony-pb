<?php

namespace App\Tests\Integration\Backend;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Backend\CompteService;
use App\Entity\Compte;
use App\Entity\Client;
use App\Backend\ClientService;

class CompteServiceTest extends KernelTestCase
{
    private static $cnx;
    
    private $compteService;
    private $clientService;
    private $client;
    
    public static function setUpBeforeClass(): void
    {
        // Mise en place d'une connexion PDO pour base de test
        self::$cnx = new \PDO('mysql:host=localhost;port=3306;dbname=banquesf_test', 'banquesf', 'banquesf');
        
        // Pour lever des exception en cas d'echec
        self::$cnx->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    public function setUp(): void
    {
        // Initialisation du jeu de données
        self::$cnx->exec(file_get_contents('tests/scripts/init.sql'));
        
        // récuperation de l'entity manager
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        // OU  BIEN
        //$entityManager = self::$container->get('doctrine')->getManager();
        
        // Recuperer le clientService
        $this->clientService = new ClientService($entityManager);
        
        // Recuperer le compteService
        $this->compteService = new CompteService($entityManager);
        
        // On créé l'objet compte de reference
        $this->client = $this->clientService->rechercherClientParId(1);
    }
    
    public function tearDown():void
    {
        // Nettoyage du jeu de données
        self::$cnx->exec(file_get_contents('tests/scripts/clean.sql'));
    }   
    
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
