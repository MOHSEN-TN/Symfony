<?php

namespace App\Tests\Controller;

use App\Controller\CommandeController;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Service\ServiceCommande;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class CommandeControllerTest extends TestCase
{
    private CommandeController $controller;
    private CommandeRepository $repository;
    private ServiceCommande $service;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(CommandeRepository::class);
        $this->service = $this->createMock(ServiceCommande::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new CommandeController($this->service);
    }

    public function testListCommande(): void
    {
        $commandes = [new Commande(), new Commande()];
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($commandes);

        $response = $this->controller->listCommande($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testCommandeClient(): void
    {
        $client = 1;
        $commandes = [new Commande()];
        
        $this->service->expects($this->once())
            ->method('getPaginetCommandeClient')
            ->with($client)
            ->willReturn($commandes);

        $response = $this->controller->commandeClient($client);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAjouterCommande(): void
    {
        $request = new Request();
        $commande = new Commande();
        
        $response = $this->controller->ajouterCommande($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteComApi(): void
    {
        $id = 1;
        $commande = new Commande();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($commande);

        $response = $this->controller->DeleteComApi($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateCommande(): void
    {
        $request = new Request();
        $id = 1;
        $commande = new Commande();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($commande);

        $response = $this->controller->updateCommande($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testPdf(): void
    {
        $id = 1;
        $commande = new Commande();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($commande);

        $response = $this->controller->pdf($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }
}