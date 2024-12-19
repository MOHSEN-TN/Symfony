<?php

namespace App\Tests\Entity;

use App\Entity\Reservation;
use DateTime;
use PHPUnit\Framework\TestCase;

class ReservationTest extends TestCase
{
    private Reservation $reservation;

    protected function setUp(): void
    {
        $this->reservation = new Reservation();
    }

    public function testDateReservation(): void
    {
        $date = new DateTime();
        $this->reservation->setDateReservation($date);
        $this->assertEquals($date, $this->reservation->getDateReservation());
    }

    public function testStatus(): void
    {
        $status = true;
        $this->reservation->setStatus($status);
        $this->assertEquals($status, $this->reservation->getStatus());
    }
} 