<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    private Category $category;

    protected function setUp(): void
    {
        $this->category = new Category();
    }

    public function testNomCategory(): void
    {
        $nom = "Catégorie test";
        $this->category->setNomCategory($nom);
        $this->assertEquals($nom, $this->category->getNomCategory());
    }

    public function testImageCategorie(): void
    {
        $image = "image.jpg";
        $this->category->setImageCategorie($image);
        $this->assertEquals($image, $this->category->getImageCategorie());
    }
} 