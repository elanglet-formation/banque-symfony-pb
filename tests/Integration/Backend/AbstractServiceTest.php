<?php

namespace App\Tests\Integration\Backend;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Backend\ClientService;
use App\Backend\CompteService;

abstract class AbstractServiceTest extends KernelTestCase
{
    protected static $cnx;
    
    protected $clientService;
    protected $compteService;
    protected $client;
    protected $entityManager;
    
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
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        // OU  BIEN
        //$entityManager = self::$container->get('doctrine')->getManager();
        
        // Recuperer le clientService
        $this->clientService = new ClientService($this->entityManager);
        
        // Recuperer le compteService
        $this->compteService = new CompteService($this->entityManager);
        
        // recuperer client
        $this->client = $this->clientService->rechercherClientParId(1);
    }
    
    public function tearDown():void
    {
        // Nettoyage du jeu de données
        self::$cnx->exec(file_get_contents('tests/scripts/clean.sql'));
    }
    
}
