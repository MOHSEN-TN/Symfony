<?php

namespace App\Tests\Entity;

use App\Entity\Produit;
use PHPUnit\Framework\TestCase;

class ProduitTest extends TestCase
{
    private Produit $produit;

    protected function setUp(): void
    {
        $this->produit = new Produit();
    }

    public function testNom(): void
    {
        $nom = "Produit test";
        $this->produit->setNom($nom);
        $this->assertEquals($nom, $this->produit->getNom());
    }

    public function testDescription(): void
    {
        $description = "Description test";
        $this->produit->setDescription($description);
        $this->assertEquals($description, $this->produit->getDescription());
    }

    public function testQuantite(): void
    {
        $quantite = 10;
        $this->produit->setQuantiteProduit($quantite);
        $this->assertEquals($quantite, $this->produit->getQuantiteProduit());
    }
} 