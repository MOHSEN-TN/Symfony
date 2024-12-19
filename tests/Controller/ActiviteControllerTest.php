<?php

namespace App\Tests\Controller;

use App\Controller\ActiviteController;
use App\Entity\Activite;
use App\Repository\ActiviteRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class ActiviteControllerTest extends TestCase
{
    private ActiviteController $controller;
    private ActiviteRepository $repository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ActiviteRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new ActiviteController();
    }

    public function testListFront(): void
    {
        $activites = [new Activite(), new Activite()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($activites);

        $response = $this->controller->listFront($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddActivite(): void
    {
        $request = new Request();
        
        $response = $this->controller->addActivite($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateActivite(): void
    {
        $request = new Request();
        $id = 1;
        $activite = new Activite();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($activite);

        $response = $this->controller->updateActivite($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteActivite(): void
    {
        $id = 1;
        $activite = new Activite();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($activite);

        $response = $this->controller->deleteActivite($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }
}