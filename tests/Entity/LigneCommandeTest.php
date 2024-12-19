<?php

namespace App\Tests\Entity;

use App\Entity\LigneCommande;
use PHPUnit\Framework\TestCase;

class LigneCommandeTest extends TestCase
{
    private LigneCommande $ligneCommande;

    protected function setUp(): void
    {
        $this->ligneCommande = new LigneCommande();
    }

    public function testQuantiteProduit(): void
    {
        $quantite = 5;
        $this->ligneCommande->setQuantiteProduit($quantite);
        $this->assertEquals($quantite, $this->ligneCommande->getQuantiteProduit());
    }

    public function testPrixUnitaire(): void
    {
        $prix = 25.99;
        $this->ligneCommande->setPrixUnitaire($prix);
        $this->assertEquals($prix, $this->ligneCommande->getPrixUnitaire());
    }
} 