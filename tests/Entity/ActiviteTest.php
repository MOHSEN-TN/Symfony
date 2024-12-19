<?php

namespace App\Tests\Entity;

use App\Entity\Activite;
use DateTime;
use PHPUnit\Framework\TestCase;

class ActiviteTest extends TestCase
{
    private Activite $activite;

    protected function setUp(): void
    {
        $this->activite = new Activite();
    }

    public function testNomActivite(): void
    {
        $nom = "Activité test";
        $this->activite->setNomAcitivite($nom);
        $this->assertEquals($nom, $this->activite->getNomAcitivite());
    }

    public function testDateActivite(): void
    {
        $date = new DateTime();
        $this->activite->setDateActivite($date);
        $this->assertEquals($date, $this->activite->getDateActivite());
    }

    public function testNbrePlaces(): void
    {
        $places = 20;
        $this->activite->setNbrePlace($places);
        $this->assertEquals($places, $this->activite->getNbrePlace());
    }
} 