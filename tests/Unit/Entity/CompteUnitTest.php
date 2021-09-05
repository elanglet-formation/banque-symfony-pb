<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Compte;
use App\Entity\Client;

class CompteUnitTest extends TestCase
{
    private $compte;
    
    public function setUp(): void 
    {
        $this->compte = new Compte();
        $this->compte->setNumero(459845135);
        $this->compte->setSolde(1000.00);
        $this->compte->setClient(new Client());
    }
    
    public function testInstantiateCompte(): void
    {
        $compte = new Compte();
        $this->assertNotNull($compte);
    }
    
    public function testGetNumero(): void
    {
        $this->assertEquals(459845135, $this->compte->getNumero());
    }
    
    public function testSetNumero(): void 
    {
        $this->compte->setNumero(956326651);
        $this->assertEquals(956326651, $this->compte->getNumero());
    }
    
    public function testGetSolde(): void
    {
        $this->assertEquals(1000.0, $this->compte->getSolde());   
    }
    
    public function testSetSolde(): void
    {
        $this->compte->setSolde(550.00);
        $this->assertEquals(550.00, $this->compte->getSolde());
    }
    
    public function testGetClient(): void
    {
        $this->assertNotNull($this->compte->getClient());
    }
    
    public function testSetClient(): void
    {
        $this->compte->setClient(new Client());
        $this->assertNotNull($this->compte->getClient());
    }
}
