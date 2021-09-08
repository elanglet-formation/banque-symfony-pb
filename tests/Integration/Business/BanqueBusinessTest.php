<?php

namespace App\Tests\Integration\Business;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Backend\ClientService;
use App\Backend\CompteService;
use App\Business\BanqueBusiness;

class BanqueBusinessTest extends KernelTestCase
{
    private static $cnx;
    
    private $compteService;
    private $clientService;
    private $banqueBusiness;
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
        
        // Créer banqueBusiness
        $this->banqueBusiness = new BanqueBusiness($this->clientService, $this->compteService);
        
        // On créé l'objet compte de reference
        $this->client = $this->clientService->rechercherClientParId(1);
    }
    
    public function tearDown():void
    {
        // Nettoyage du jeu de données
        self::$cnx->exec(file_get_contents('tests/scripts/clean.sql'));
    }
    
    public function testAuthentifier(): void
    {
        // Valeur de reference
        $idClient = $this->client->getId();
        $motDePasse = $this->client->getMotdepasse();
        
        // Appelle de la fonction a tester
        $clientAuthentifie = $this->banqueBusiness->authentifier($idClient, $motDePasse);
        
        // Assertions
        $this->assertEquals($this->client, $clientAuthentifie);
        
    }
    
    public function testAuthentifierErreur(): void
    {
        $this->expectException(\Exception::class);
        $this->banqueBusiness->authentifier(1, 'bidon');
    }
    
    public function testMesComptes(): void
    {
        
        $listeComptes = $this->banqueBusiness->mesComptes(1);
        $this->assertCount(2, $listeComptes);
        
        foreach ($listeComptes as $compte)
        {
            $this->assertEquals($this->client, $compte->getClient());
        }
        
    }
}
