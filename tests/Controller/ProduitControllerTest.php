<?php

namespace App\Tests\Controller;

use App\Controller\ProduitController;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class ProduitControllerTest extends TestCase
{
    private ProduitController $controller;
    private ProduitRepository $repository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ProduitRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new ProduitController();
    }

    public function testListp(): void
    {
        $produits = [new Produit(), new Produit()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($produits);
            
        $this->doctrine->expects($this->once())
            ->method('getRepository')
            ->willReturn($this->repository);

        $response = $this->controller->listp($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddp(): void
    {
        $request = new Request();
        $produit = new Produit();
        
        $response = $this->controller->addp($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdatep(): void
    {
        $request = new Request();
        $id = 1;
        $produit = new Produit();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($produit);

        $response = $this->controller->updatep($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeletep(): void
    {
        $id = 1;
        $produit = new Produit();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($produit);

        $response = $this->controller->deletep($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testSearchProduit(): void
    {
        $request = new Request(['searchTerm' => 'test']);
        
        $this->repository->expects($this->once())
            ->method('findBySearchTerm')
            ->with('test')
            ->willReturn([]);

        $response = $this->controller->searchProduit($request, $this->repository);
        $this->assertInstanceOf(Response::class, $response);
    }
}