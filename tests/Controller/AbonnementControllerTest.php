<?php

namespace App\Tests\Controller;

use App\Controller\AbonnementController;
use App\Entity\Abonnement;
use App\Repository\AbonnementRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class AbonnementControllerTest extends TestCase
{
    private AbonnementController $controller;
    private AbonnementRepository $repository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(AbonnementRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new AbonnementController();
    }

    public function testListAbonnement(): void
    {
        $abonnements = [new Abonnement(), new Abonnement()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($abonnements);

        $response = $this->controller->listAbonnement($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddAbonnement(): void
    {
        $request = new Request();
        
        $response = $this->controller->addAbonnement($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateAbonnement(): void
    {
        $request = new Request();
        $id = 1;
        $abonnement = new Abonnement();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($abonnement);

        $response = $this->controller->updateAbonnement($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteAbonnement(): void
    {
        $id = 1;
        $abonnement = new Abonnement();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($abonnement);

        $response = $this->controller->deleteAbonnement($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }
}