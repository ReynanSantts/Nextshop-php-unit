<?php

use PHPUnit\Framework\TestCase;
use Controller\ControllerProduct;
use Model\ModelProduct;
use PDO;

class ProductTest extends TestCase
{
    private $productController;
    private $mockModelProduct;

    public function setUp(): void
    {
        $this->mockModelProduct = $this->createMock(ModelProduct::class);
        $mockPdo = $this->createMock(PDO::class);
        
        $this->productController = new ControllerProduct($mockPdo, $this->mockModelProduct);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_list_all_products()
    {
        $expectedProducts = [
            [
                "id" => 1,
                "name" => "Fone De Ouvido In-ear Kz Edx Pro retorno de palco",
                "price" => 32.00,
                "image" => "../templates/images/fonekqz.png",
                "qtd" => 15
            ],
            [
                "id" => 2,
                "name" => "Placa de Vídeo RTX 4060 Ti Eagle OC Gigabyte NVIDIA GeForce, 8 GB GDDR6",
                "price" => 2499.99,
                "image" => "../templates/images/placa.jfif",
                "qtd" => 8
            ]
        ];

        $this->mockModelProduct->method('getAllProducts')->willReturn($expectedProducts);

        $result = $this->productController->listProducts();

        $this->assertEquals($expectedProducts, $result);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_get_specific_product_by_id()
    {
        $expectedProduct = [
            "id" => 2,
            "name" => "Placa de Vídeo RTX 4060 Ti Eagle OC Gigabyte NVIDIA GeForce, 8 GB GDDR6",
            "price" => 2499.99,
            "image" => "../templates/images/placa.jfif",
            "qtd" => 8
        ];

        // CORREÇÃO: willReturn() ANTES de with()
        $this->mockModelProduct->method('getProductById')
            ->willReturn($expectedProduct);

        $result = $this->productController->getProduct(2);

        $this->assertEquals($expectedProduct, $result);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_be_able_to_add_new_product()
    {
        // CORREÇÃO: willReturn() ANTES de with()
        $this->mockModelProduct->method('addProduct')
            ->willReturn(true);

        $result = $this->productController->addProduct(
            'Monitor Gamer 24 Poleladas 144Hz',
            899.99,
            '../templates/images/monitor.jpg',
            10
        );

        $this->assertTrue($result);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_shouldnt_get_product_with_invalid_id()
    {
        // CORREÇÃO: willReturn() ANTES de with()
        $this->mockModelProduct->method('getProductById')
            ->willReturn(false);

        $result = $this->productController->getProduct(999);

        $this->assertFalse($result);
    }
}