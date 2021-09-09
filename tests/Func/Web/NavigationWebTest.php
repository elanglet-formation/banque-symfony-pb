<?php

namespace App\Tests\Func\Web;

use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverDimension;

class NavigationWebTest extends TestCase
{
    private $webDriver;
    private $baseUrl;
    
    public function setUp(): void
    {
        // $this->webDriver = RemoteWebDriver::create("http://localhost:4444", DesiredCapabilities::firefox());
        $this->baseUrl = "http://localhost";
    }
    
    public function tearDown(): void
    {
        $this->webDriver->quit();
    }
    
    public function specifierNavigateur()
    {
        return [
            ['4444', DesiredCapabilities::firefox()] ,
            ['4445', DesiredCapabilities::chrome()]
        ];
    }
    
    /**
     * @dataProvider specifierNavigateur
     */
    public function testConnexionClient($port, $caps): void
    {
        $this->webDriver = RemoteWebDriver::create("http://localhost:" . $port, $caps);
        
        // Ouverture de la page Web
        $this->webDriver->get($this->baseUrl . "/");
        //$this->webDriver->manage()->window()->maximize();
        $this->webDriver->manage()->window()->setSize(new WebDriverDimension(1920, 1080));
        
        // On verifie le titre de la page
        $titrePage = $this->webDriver->findElement(WebDriverBy::cssSelector("h2"))->getText();
        $this->assertEquals("Bienvenue sur votre Banque en ligne !!!", $titrePage);
        
        // Click sur le lien accès client
        $this->webDriver->findElement(WebDriverBy::id("link-client"))->click();
        // On verifie le titre acces client
        $titrePage = $this->webDriver->findElement(WebDriverBy::cssSelector("h3"))->getText();
        $this->assertEquals("Identification Client", $titrePage);
        
        // saisie du formulaire
        $this->webDriver->findElement(WebDriverBy::id("identification_form_identifiant"))->sendKeys("1");
        $this->webDriver->findElement(WebDriverBy::id("identification_form_mot_de_passe"))->sendKeys("secret");
        $this->webDriver->findElement(WebDriverBy::id("identification_form_submit"))->click();
        
        // on verifie que le bonjour ... est la
        $AccueilClient = $this->webDriver->findElement(WebDriverBy::linkText("Bonjour Robert DUPONT !"));
        $this->assertNotNull($AccueilClient);
        
        // On clique sur Mes opérations
        $this->webDriver->findElement(WebDriverBy::id("navbarDropdown"))->click();
        $this->webDriver->findElement(WebDriverBy::linkText("Mes Comptes"))->click();
        
        $titrePage = $this->webDriver->findElement(WebDriverBy::cssSelector("h3"))->getText();
        $this->assertEquals("Résumé de votre situation", $titrePage);
        
        $titrePage = $this->webDriver->findElement(WebDriverBy::cssSelector("td:nth-child(1)"))->getText();
        $this->assertEquals("78954263", $titrePage);
        
        $titrePage = $this->webDriver->findElement(WebDriverBy::cssSelector("td:nth-child(2)"))->getText();
        $this->assertEquals("5000.00 €", $titrePage);
    }
}
