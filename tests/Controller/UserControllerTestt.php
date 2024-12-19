<?php

namespace App\Tests\Controller;

use App\Controller\UserController;
use App\Entity\User;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserControllerTestt extends TestCase
{
    private UserController $controller;
    private UserRepository $repository;
    private ManagerRegistry $doctrine;
    private UserPasswordHasherInterface $passwordHasher;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);
        $this->controller = new UserController();
    }

    public function testListUser(): void
    {
        $users = [new User(), new User()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($users);

        $response = $this->controller->listUser($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddUser(): void
    {
        $request = new Request();
        
        $this->passwordHasher->expects($this->once())
            ->method('hashPassword')
            ->willReturn('hashed_password');

        $response = $this->controller->addUser($request, $this->doctrine, $this->passwordHasher);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateUser(): void
    {
        $request = new Request();
        $id = 1;
        $user = new User();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($user);

        $response = $this->controller->updateUser($request, $id, $this->doctrine, $this->passwordHasher);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteUser(): void
    {
        $id = 1;
        $user = new User();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($user);

        $response = $this->controller->deleteUser($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testBanUser(): void
    {
        $id = 1;
        $user = new User();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($user);

        $response = $this->controller->banUser($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUnbanUser(): void
    {
        $id = 1;
        $user = new User();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($user);

        $response = $this->controller->unbanUser($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }
}