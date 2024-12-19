<?php

namespace App\Tests\Controller;

use App\Controller\CategoryController;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;

class CategoryControllerTest extends TestCase
{
    private CategoryController $controller;
    private CategoryRepository $repository;
    private ManagerRegistry $doctrine;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(CategoryRepository::class);
        $this->doctrine = $this->createMock(ManagerRegistry::class);
        $this->controller = new CategoryController();
    }

    public function testListCategory(): void
    {
        $categories = [new Category(), new Category()];
        
        $this->repository->expects($this->once())
            ->method('findAll')
            ->willReturn($categories);

        $response = $this->controller->listCategory($this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testAddCategory(): void
    {
        $request = new Request();
        
        $response = $this->controller->addCategory($request, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testUpdateCategory(): void
    {
        $request = new Request();
        $id = 1;
        $category = new Category();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($category);

        $response = $this->controller->updateCategory($request, $id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testDeleteCategory(): void
    {
        $id = 1;
        $category = new Category();
        
        $this->repository->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($category);

        $response = $this->controller->deleteCategory($id, $this->doctrine);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testSearchCategory(): void
    {
        $request = new Request(['searchTerm' => 'test']);
        
        $this->repository->expects($this->once())
            ->method('findBySearchTerm')
            ->with('test')
            ->willReturn([]);

        $response = $this->controller->searchCategory($request, $this->repository);
        $this->assertInstanceOf(Response::class, $response);
    }
}