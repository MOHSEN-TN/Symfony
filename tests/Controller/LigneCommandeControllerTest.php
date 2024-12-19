<?php

namespace App\Tests\Controller;

use App\Controller\LigneCommandeController;
use App\Entity\LigneCommande;
use App\Repository\LigneCommandeRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class LigneCommandeControllerTest extends TestCase
{
    private LigneCommandeController $controller;
    private LigneCommandeRepository $repository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(LigneCommandeRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new LigneCommandeController();
    }

    public function testListLigneCommande(): void
    {
        $ligneCommandes = [new LigneCommande(), new LigneCommande()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($ligneCommandes);

        $response = $this->controller->listLigneCommande($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddLigneCommande(): void
    {
        $request = new Request();
        
        $response = $this->controller->addLigneCommande($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteLigneCommande(): void
    {
        $id = 1;
        $ligneCommande = new LigneCommande();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($ligneCommande);

        $response = $this->controller->deleteLigneCommande($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }
}