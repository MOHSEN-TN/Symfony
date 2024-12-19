<?php

namespace App\Tests\Controller;

use App\Controller\SecurityController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityControllerTest extends TestCase
{
    private SecurityController $controller;
    private AuthenticationUtils $authenticationUtils;

    protected function setUp(): void
    {
        $this->authenticationUtils = $this->createMock(AuthenticationUtils::class);
        $this->controller = new SecurityController();
    }

    public function testLogin(): void
    {
        $this->authenticationUtils->expects($this->once())
            ->method('getLastAuthenticationError')
            ->willReturn(null);

        $this->authenticationUtils->expects($this->once())
            ->method('getLastUsername')
            ->willReturn('test@test.com');

        $response = $this->controller->login($this->authenticationUtils);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testLogout(): void
    {
        $this->expectException(\LogicException::class);
        $this->controller->logout();
    }
} 