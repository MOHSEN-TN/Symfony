<?php

namespace App\Tests\Entity;

use App\Entity\Coach;
use PHPUnit\Framework\TestCase;

class CoachTest extends TestCase
{
    private Coach $coach;

    protected function setUp(): void
    {
        $this->coach = new Coach();
    }

    public function testNomCoach(): void
    {
        $nom = "Coach test";
        $this->coach->setNomCoach($nom);
        $this->assertEquals($nom, $this->coach->getNomCoach());
    }

    public function testAgeCoach(): void
    {
        $age = 30;
        $this->coach->setAgeCoach($age);
        $this->assertEquals($age, $this->coach->getAgeCoach());
    }

    public function testImage(): void
    {
        $image = "coach.jpg";
        $this->coach->setImage($image);
        $this->assertEquals($image, $this->coach->getImage());
    }
} 