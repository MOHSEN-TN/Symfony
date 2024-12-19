<?php

namespace App\Tests\Controller;

use App\Controller\CoachController;
use App\Entity\Coach;
use App\Repository\CoachRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class CoachControllerTest extends TestCase
{
    private CoachController $controller;
    private CoachRepository $repository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(CoachRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new CoachController();
    }

    public function testListCoach(): void
    {
        $coaches = [new Coach(), new Coach()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($coaches);

        $response = $this->controller->listCoach($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddCoach(): void
    {
        $request = new Request();
        
        $response = $this->controller->addCoach($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateCoach(): void
    {
        $request = new Request();
        $id = 1;
        $coach = new Coach();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($coach);

        $response = $this->controller->updateCoach($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteCoach(): void
    {
        $id = 1;
        $coach = new Coach();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($coach);

        $response = $this->controller->deleteCoach($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testSearchCoach(): void
    {
        $request = new Request(['searchTerm' => 'test']);
        
        $this->repository->expects($this->once())
            ->method('findBySearchTerm')
            ->with('test')
            ->willReturn([]);

        $response = $this->controller->searchCoach($request, $this->repository);
        $this->assertInstanceOf(Response::class, $response);
    }
}