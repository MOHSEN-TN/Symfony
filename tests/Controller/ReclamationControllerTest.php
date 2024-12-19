<?php

namespace App\Tests\Controller;

use App\Controller\ReclamationController;
use App\Entity\Reclamation;
use App\Repository\ReclamationRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class ReclamationControllerTest extends TestCase
{
    private ReclamationController $controller;
    private ReclamationRepository $repository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ReclamationRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new ReclamationController();
    }

    public function testListReclamation(): void
    {
        $reclamations = [new Reclamation(), new Reclamation()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($reclamations);

        $response = $this->controller->listReclamation($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddReclamation(): void
    {
        $request = new Request();
        
        $response = $this->controller->addReclamation($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testTraiterReclamation(): void
    {
        $id = 1;
        $reclamation = new Reclamation();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($reclamation);

        $response = $this->controller->traiterReclamation($this->doctrine, $id);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteReclamation(): void
    {
        $id = 1;
        $reclamation = new Reclamation();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($reclamation);

        $response = $this->controller->deleteReclamation($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }
}