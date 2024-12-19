<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        $this->user = new User();
    }

    public function testEmail(): void
    {
        $email = "test@test.com";
        $this->user->setEmail($email);
        $this->assertEquals($email, $this->user->getEmail());
    }

    public function testNom(): void
    {
        $nom = "Dupont";
        $this->user->setNom($nom);
        $this->assertEquals($nom, $this->user->getNom());
    }

    public function testPrenom(): void
    {
        $prenom = "Jean";
        $this->user->setPrenom($prenom);
        $this->assertEquals($prenom, $this->user->getPrenom());
    }

    public function testRoles(): void
    {
        $roles = ["ROLE_USER"];
        $this->user->setRoles($roles);
        $this->assertEquals($roles, $this->user->getRoles());
    }
} 