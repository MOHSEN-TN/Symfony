<?php

namespace App\Tests\Controller;

use App\Controller\ReservationController;
use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class ReservationControllerTest extends TestCase
{
    private ReservationController $controller;
    private ReservationRepository $repository;
    private UserRepository $userRepository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ReservationRepository::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new ReservationController();
    }

    public function testListReservation(): void
    {
        $reservations = [new Reservation(), new Reservation()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($reservations);

        $response = $this->controller->listReservation($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddReservation(): void
    {
        $request = new Request();
        
        $response = $this->controller->addReservation($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateReservation(): void
    {
        $request = new Request();
        $id = 1;
        $reservation = new Reservation();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($reservation);

        $response = $this->controller->updateReservation($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteReservation(): void
    {
        $id = 1;
        $reservation = new Reservation();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($reservation);

        $response = $this->controller->deleteReservation($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testEnvoyerEmail(): void
    {
        $id = 1;
        $user = new User();
        $user->setEmail('test@test.com');
        
        $this->userRepository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($user);

        $result = $this->controller->envoyerEmail($id, $this->userRepository, $this->repository);
        $this->assertTrue($result);
    }
}