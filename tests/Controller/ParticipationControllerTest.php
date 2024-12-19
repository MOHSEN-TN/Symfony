<?php

namespace App\Tests\Controller;

use App\Controller\ParticipationController;
use App\Entity\Participation;
use App\Entity\User;
use App\Repository\ParticipationRepository;
use App\Services\QrcodeService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class ParticipationControllerTest extends TestCase
{
    private ParticipationController $controller;
    private ParticipationRepository $repository;
    private QrcodeService $qrcodeService;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(ParticipationRepository::class);
        $this->qrcodeService = $this->createMock(QrcodeService::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new ParticipationController();
    }

    public function testListParticipation(): void
    {
        $participations = [new Participation(), new Participation()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($participations);

        $response = $this->controller->listParticipation($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testListUser(): void
    {
        $user = new User();
        $participations = [new Participation(), new Participation()];
        
        $this->repository->expects($this->once())
            ->method('FindPartsById')
            ->willReturn($participations);

        $response = $this->controller->listUser($this->repository, $this->qrcodeService);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddParticipation(): void
    {
        $request = new Request();
        
        $response = $this->controller->addParticipation($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteParticipation(): void
    {
        $id = 1;
        $participation = new Participation();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($participation);

        $response = $this->controller->deleteParticipation($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }
}