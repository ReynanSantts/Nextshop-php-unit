<?php
namespace Controller;

use Model\ModelProduct;
use PDO;

class ControllerProduct
{
    private $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new ModelProduct($pdo);
    }

    public function listProducts()
    {
        return $this->model->getAllProducts();
    }

    public function getProduct($id)
    {
        return $this->model->getProductById($id);
    }

    // Método para inserir produto (para o finalizarPagamento.php)
    public function addProduct($name, $price, $image)
    {
        return $this->model->addProduct($name, $price, $image);
    }
}
