<?php

namespace App\Tests\Entity;

use App\Entity\TraitementReclamation;
use DateTime;
use PHPUnit\Framework\TestCase;

class TraitementReclamationTest extends TestCase
{
    private TraitementReclamation $traitementReclamation;

    protected function setUp(): void
    {
        $this->traitementReclamation = new TraitementReclamation();
    }

    public function testDateReponse(): void
    {
        $date = new DateTime();
        $this->traitementReclamation->setDateReponse($date);
        $this->assertEquals($date, $this->traitementReclamation->getDateReponse());
    }

    public function testDescriptionReponse(): void
    {
        $description = "Réponse test";
        $this->traitementReclamation->setDescriptionReponse($description);
        $this->assertEquals($description, $this->traitementReclamation->getDescriptionReponse());
    }
} 