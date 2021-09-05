<?php
namespace App\Business;

use App\Backend\ClientService;
use App\Backend\CompteService;
use App\Entity\Client;

class BanqueBusiness
{
    private $clientService;
    private $compteService;

    public function __construct(ClientService $clientService, CompteService $compteService)
    {
        $this->clientService = $clientService;
        $this->compteService = $compteService;
    }
    
    public function authentifier(int $idClient, string $motDePasse) : Client
    {
        try {
            $client = $this->clientService->rechercherClientParId($idClient);
                        
            if($client != null && $motDePasse != null && $motDePasse === $client->getMotdepasse()) {
                return $client;
            }
            else {
                throw new \Exception();
            }
        } 
        catch (\Exception $e) {
            throw new \Exception("Erreur d'authentification.");
        }
    }
    
    public function mesComptes(int $idClient) : array
    {
        try {
            $client = $this->clientService->rechercherClientParId($idClient);
            
            $listeDesComptes = $this->compteService->rechercherComptesClient($client);
            
            return $listeDesComptes;
        }
        catch (\Exception $e) {
            throw new \Exception("Erreur de récupération des comptes.");
        }
    }
    
    public function virement(int $numeroDebit, int $numeroCredit, float $montant) : void
    {
        try {
            $compteADebiter = $this->compteService->rechercherCompteParNumero($numeroDebit);
            $compteACrediter = $this->compteService->rechercherCompteParNumero($numeroCredit);
            
            $compteADebiter->setSolde($compteADebiter->getSolde() - $montant);
            $compteACrediter->setSolde($compteACrediter->getSolde() + $montant);
            
            $this->compteService->modifierCompte($compteADebiter);
            $this->compteService->modifierCompte($compteACrediter);
        }
        catch (\Exception $e) {
            throw new \Exception("Erreur d'enregistrement du virement.");
        }
    }
}
