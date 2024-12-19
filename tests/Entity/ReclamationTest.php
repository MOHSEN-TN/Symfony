<?php

namespace App\Tests\Entity;

use App\Entity\Reclamation;
use DateTime;
use PHPUnit\Framework\TestCase;

class ReclamationTest extends TestCase
{
    private Reclamation $reclamation;

    protected function setUp(): void
    {
        $this->reclamation = new Reclamation();
    }

    public function testDateReclamation(): void
    {
        $date = new DateTime();
        $this->reclamation->setDateReclamation($date);
        $this->assertEquals($date, $this->reclamation->getDateReclamation());
    }

    public function testDescription(): void
    {
        $description = "Description de la réclamation";
        $this->reclamation->setDescription($description);
        $this->assertEquals($description, $this->reclamation->getDescription());
    }

    public function testStatus(): void
    {
        $status = "En cours";
        $this->reclamation->setStatus($status);
        $this->assertEquals($status, $this->reclamation->getStatus());
    }
} 