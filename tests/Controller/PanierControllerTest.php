<?php

namespace App\Tests\Controller;

use App\Controller\PanierController;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\Persistence\ManagerRegistry;

class PanierControllerTest extends TestCase
{
    private PanierController $controller;
    private PanierRepository $panierRepository;
    private ProduitRepository $produitRepository;
    private SessionInterface $session;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->panierRepository = $this->createMock(PanierRepository::class);
        $this->produitRepository = $this->createMock(ProduitRepository::class);
        $this->session = $this->createMock(SessionInterface::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new PanierController();
    }

    public function testIndex(): void
    {
        $panier = ['1' => 2]; // produitId => quantity
        
        $this->session->expects($this->once())
            ->method('get')
            ->with('panier', [])
            ->willReturn($panier);

        $response = $this->controller->index($this->session, $this->produitRepository);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAdd(): void
    {
        $id = 1;
        $produit = new Produit();
        
        $this->produitRepository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($produit);

        $response = $this->controller->add($id, $this->session, $this->produitRepository);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testRemove(): void
    {
        $id = 1;
        
        $this->session->expects($this->once())
            ->method('get')
            ->with('panier', [])
            ->willReturn(['1' => 1]);

        $response = $this->controller->remove($id, $this->session);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDelete(): void
    {
        $id = 1;
        
        $this->session->expects($this->once())
            ->method('get')
            ->with('panier', [])
            ->willReturn(['1' => 1]);

        $response = $this->controller->delete($id, $this->session);
        $this->assertInstanceOf(Response::class, $response);
    }
} 