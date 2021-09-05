<?php
namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Client;

class ClientUnitTest extends TestCase
{

    private $client;

    public function setUp(): void
    {
        $this->client = new Client();
        $this->client->setNom("DUPONT");
        $this->client->setPrenom("Robert");
        $this->client->setAdresse("40 rue de la Paix");
        $this->client->setCodePostal("75007");
        $this->client->setVille("Paris");
        $this->client->setMotDePasse("secret");
    }

    public function testInstantiateClient(): void
    {
        $client = new Client();
        $this->assertNotNull($client);
    }

    public function testGetNom(): void
    {
        $this->assertEquals("DUPONT", $this->client->getNom());
    }

    public function testSetNom(): void
    {
        $this->client->setNom("DURAND");
        $this->assertEquals("DURAND", $this->client->getNom());
    }

    public function testGetPrenom(): void
    {
        $this->assertEquals("Robert", $this->client->getPrenom());
    }

    public function testSetPrenom(): void
    {
        $this->client->setPrenom("Michel");
        $this->assertEquals("Michel", $this->client->getPrenom());
    }

    public function testGetAdresse(): void
    {
        $this->assertEquals("40 rue de la Paix", $this->client->getAdresse());
    }

    public function testSetAdresse(): void
    {
        $this->client->setAdresse("222 rue Du Tertre");
        $this->assertEquals("222 rue Du Tertre", $this->client->getAdresse());
    }

    public function testGetCodePostal(): void
    {
        $this->assertEquals("75007", $this->client->getCodePostal());
    }

    public function testSetCodePostal(): void
    {
        $this->client->setCodePostal("44000");
        $this->assertEquals("44000", $this->client->getCodePostal());
    }

    public function testGetVille(): void
    {
        $this->assertEquals("Paris", $this->client->getVille());
    }

    public function testSetVille(): void
    {
        $this->client->setVille("Nantes");
        $this->assertEquals("Nantes", $this->client->getVille());
    }

    public function testGetMotDePasse(): void
    {
        $this->assertEquals("secret", $this->client->getMotDePasse());
    }

    public function testSetMotDePasse(): void
    {
        $this->client->setMotDePasse("123456");
        $this->assertEquals("123456", $this->client->getMotDePasse());
    }
}
