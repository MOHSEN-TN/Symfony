<?php

namespace App\Tests\Entity;

use App\Entity\Commande;
use DateTime;
use PHPUnit\Framework\TestCase;

class CommandeTest extends TestCase
{
    private Commande $commande;

    protected function setUp(): void
    {
        $this->commande = new Commande();
    }

    public function testDateCommande(): void
    {
        $date = new DateTime();
        $this->commande->setDateCommande($date);
        $this->assertEquals($date, $this->commande->getDateCommande());
    }

    public function testAdresseLivraison(): void
    {
        $adresse = "123 rue test";
        $this->commande->setAdresseLivraison($adresse);
        $this->assertEquals($adresse, $this->commande->getAdresseLivraison());
    }

    public function testPrixCommande(): void
    {
        $prix = 150.0;
        $this->commande->setPrixCommande($prix);
        $this->assertEquals($prix, $this->commande->getPrixCommande());
    }
} 