<?php

namespace App\Tests\Controller;

use App\Controller\TraitementReclamationController;
use App\Entity\TraitementReclamation;
use App\Entity\Reclamation;
use App\Repository\TraitementReclamationRepository;
use App\Repository\ReclamationRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class TraitementReclamationControllerTest extends TestCase
{
    private TraitementReclamationController $controller;
    private TraitementReclamationRepository $repository;
    private ReclamationRepository $reclamationRepository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(TraitementReclamationRepository::class);
        $this->reclamationRepository = $this->createMock(ReclamationRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new TraitementReclamationController();
    }

    public function testListTraitement(): void
    {
        $traitements = [new TraitementReclamation(), new TraitementReclamation()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($traitements);

        $response = $this->controller->listTraitement($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddTraitement(): void
    {
        $request = new Request();
        $reclamationId = 1;
        $reclamation = new Reclamation();
        
        $this->reclamationRepository->expects($this->once())
            ->method('find')
            ->with($reclamationId)
            ->willReturn($reclamation);

        $response = $this->controller->addTraitement($request, $this->doctrine, $reclamationId);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateTraitement(): void
    {
        $request = new Request();
        $id = 1;
        $traitement = new TraitementReclamation();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($traitement);

        $response = $this->controller->updateTraitement($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteTraitement(): void
    {
        $id = 1;
        $traitement = new TraitementReclamation();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($traitement);

        $response = $this->controller->deleteTraitement($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testSearchTraitement(): void
    {
        $request = new Request(['searchTerm' => 'test']);
        
        $this->repository->expects($this->once())
            ->method('findBySearchTerm')
            ->with('test')
            ->willReturn([]);

        $response = $this->controller->searchTraitement($request, $this->repository);
        $this->assertInstanceOf(Response::class, $response);
    }
} 