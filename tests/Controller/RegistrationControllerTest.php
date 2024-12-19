<?php

namespace App\Tests\Controller;

use App\Controller\RegistrationController;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Mailer\MailerInterface;

class RegistrationControllerTest extends TestCase
{
    private RegistrationController $controller;
    private UserRepository $repository;
    private UserPasswordHasherInterface $passwordHasher;
    private MailerInterface $mailer;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->passwordHasher = $this->createMock(UserPasswordHasherInterface::class);
        $this->mailer = $this->createMock(MailerInterface::class);
        $this->controller = new RegistrationController();
    }

    public function testRegister(): void
    {
        $request = new Request();
        
        $this->passwordHasher->expects($this->once())
            ->method('hashPassword')
            ->willReturn('hashed_password');

        $response = $this->controller->register($request, $this->passwordHasher, $this->mailer);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testConfirmAccount(): void
    {
        $token = '123456';
        $user = new User();
        
        $this->repository->expects($this->once())
            ->method('findOneBy')
            ->with(['token' => $token])
            ->willReturn($user);

        $response = $this->controller->confirmAccount($this->repository, $token);
        $this->assertInstanceOf(Response::class, $response);
    }
}