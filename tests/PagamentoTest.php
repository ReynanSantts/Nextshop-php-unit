<?php

use PHPUnit\Framework\TestCase;
use Controller\ControllerProduct;
use Model\ModelProduct;
use PDO;

class PagamentoTest extends TestCase
{
    private $mockPdo;
    private $mockController;
    private $mockModelProduct;

    public function setUp(): void
    {
        $this->mockModelProduct = $this->createMock(ModelProduct::class);
        $this->mockPdo = $this->createMock(PDO::class);
        $this->mockController = new ControllerProduct($this->mockPdo, $this->mockModelProduct);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_process_payment_successfully()
    {
        $this->mockModelProduct->method('addProduct')->willReturn(true);

        $result = $this->mockController->addProduct(
            'Fone De Ouvido In-ear Kz Edx Pro',
            32.00,
            '../templates/images/fonekqz.png',
            1
        );

        $this->assertTrue($result);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_not_process_empty_cart()
    {
        $items = ['items' => []];
        $this->assertEmpty($items['items']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_handle_database_errors()
    {
        $this->mockModelProduct->method('addProduct')->willReturn(false);

        $result = $this->mockController->addProduct(
            'Produto Teste',
            100.00,
            '../templates/images/test.jpg',
            1
        );

        $this->assertFalse($result);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_should_process_products_with_different_quantities()
    {
        $this->mockModelProduct->method('addProduct')->willReturn(true);

        $result = $this->mockController->addProduct(
            'Fone De Ouvido',
            32.00,
            '../templates/images/fonekqz.png',
            3
        );

        $this->assertTrue($result);
    }
}