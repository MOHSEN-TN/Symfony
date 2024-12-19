<?php

namespace App\Tests\Entity;

use App\Entity\Abonnement;
use PHPUnit\Framework\TestCase;

class AbonnementTest extends TestCase
{
    private Abonnement $abonnement;

    protected function setUp(): void
    {
        $this->abonnement = new Abonnement();
    }

    public function testNomAbonnement(): void
    {
        $nom = "Abonnement test";
        $this->abonnement->setNomAbonnement($nom);
        $this->assertEquals($nom, $this->abonnement->getNomAbonnement());
    }

    public function testPrixAbonnement(): void
    {
        $prix = 99.99;
        $this->abonnement->setPrixAbonnement($prix);
        $this->assertEquals($prix, $this->abonnement->getPrixAbonnement());
    }

    public function testDureeAbonnement(): void
    {
        $duree = 30;
        $this->abonnement->setDureeAbonnement($duree);
        $this->assertEquals($duree, $this->abonnement->getDureeAbonnement());
    }
} 