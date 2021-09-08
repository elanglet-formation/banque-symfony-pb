<?php

namespace App\Tests\Integration\Backend;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Backend\ClientService;
use App\Entity\Client;

class ClientServiceTest extends KernelTestCase
{
    private static $cnx;
    
    private $clientService;
    
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
    }
    
    public function tearDown():void
    {
        // Nettoyage du jeu de données
        self::$cnx->exec(file_get_contents('tests/scripts/clean.sql'));
    }
    
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
}
