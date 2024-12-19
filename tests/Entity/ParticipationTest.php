<?php

namespace App\Tests\Entity;

use App\Entity\Participation;
use DateTime;
use PHPUnit\Framework\TestCase;

class ParticipationTest extends TestCase
{
    private Participation $participation;

    protected function setUp(): void
    {
        $this->participation = new Participation();
    }

    public function testDateParticipation(): void
    {
        $date = new DateTime();
        $this->participation->setDateParticipation($date);
        $this->assertEquals($date, $this->participation->getDateParticipation());
    }
} 