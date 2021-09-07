<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Client;

class ClientTest extends TestCase
{
    // Variable pour chargé un client a chaque test
    private $client;   
    
    public function setUp(): void
    {
        // L'objet client sera créé avant chaque test
        $this->client = new Client();
        
        $this->client->setId(1);
        $this->client->setNom('Barre');
        $this->client->setPrenom('Denis');
        $this->client->setAdresse('69 rue des collines');
        $this->client->setCodepostal('35000');
        $this->client->setVille('Rennes');
        $this->client->setMotdepasse('pbo');
        
    }
    
    public function testGetId(): void
    {
        // On appelle la méthode à tester
        $id = $this->client->getId();
        
        //On fait la vérification
        $this->assertEquals(1, $id);
    }
    
    public function testSetId(): void
    {
        // On appelle la méthode à tester
        $this->client->setId(2);
        
        //On fait la vérification
        $this->assertEquals(2, $this->client->getId());
    }
    
    public function testGetNom(): void
    {
        // On appelle la méthode à tester
        $nom = $this->client->getNom();
        
        //On fait la vérification
        $this->assertEquals('Barre', $nom);
    }
    
    public function testSetNom(): void
    {
        // On appelle la méthode à tester
        $this->client->setNom('Chon');
        
        //On fait la vérification
        $this->assertEquals('Chon', $this->client->getNom());
    }
    
    public function testGetPrenom(): void
    {
        // On appelle la méthode à tester
        $prenom = $this->client->getPrenom();
        
        //On fait la vérification
        $this->assertEquals('Denis', $prenom);
    }
    
    public function testSetPrenom(): void
    {
        // On appelle la méthode à tester
        $this->client->setPrenom('Marcel');
        
        //On fait la vérification
        $this->assertEquals('Marcel', $this->client->getPrenom());
    }
    
    public function testGetAdresse(): void
    {
        // On appelle la méthode à tester
        $adresse = $this->client->getAdresse();
        
        //On fait la vérification
        $this->assertEquals('69 rue des collines', $adresse);
    }
    
    public function testSetAdresse(): void
    {
        // On appelle la méthode à tester
        $this->client->setAdresse('30 rue du ruisseau');
        
        //On fait la vérification
        $this->assertEquals('30 rue du ruisseau', $this->client->getAdresse());
    }
    
    public function testGetCodepostal(): void
    {
        // On appelle la méthode à tester
        $cp = $this->client->getCodepostal();
        
        //On fait la vérification
        $this->assertEquals('35000', $cp);
    }
    
    public function testSetCodepostal(): void
    {
        // On appelle la méthode à tester
        $this->client->setCodepostal('35137');
        
        //On fait la vérification
        $this->assertEquals('35137', $this->client->getCodepostal());
    }
    
    public function testGetVille(): void
    {
        // On appelle la méthode à tester
        $Ville = $this->client->getVille();
        
        //On fait la vérification
        $this->assertEquals('Rennes', $Ville);
    }
    
    public function testSetVille(): void
    {
        // On appelle la méthode à tester
        $this->client->setVille('Bédée');
        
        //On fait la vérification
        $this->assertEquals('Bédée', $this->client->getVille());
    }
    
    public function testMotdepasse(): void
    {
        // On appelle la méthode à tester
        $Motdepasse = $this->client->getMotdepasse();
        
        //On fait la vérification
        $this->assertEquals('pbo', $Motdepasse);
    }
    
    public function testSetMotdepasse(): void
    {
        // On appelle la méthode à tester
        $this->client->setMotdepasse('pb');
        
        //On fait la vérification
        $this->assertEquals('pb', $this->client->getMotdepasse());
    }
    
    
}
