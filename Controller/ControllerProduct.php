<?php
namespace Controller;

use Model\ModelProduct; // Usa a classe ModelProduct do namespace Model
use PDO;

class ControllerProduct
{
    private $model; // Propriedade para armazenar a instância do model

    // Construtor recebe a conexão PDO e cria o model
    public function __construct(PDO $pdo)
    {
        $this->model = new ModelProduct($pdo);
    }

    // Método para listar todos os produtos, chamando o método do model
    public function listProducts()
    {
        return $this->model->getAllProducts();
    }

    // Método para obter um produto específico pelo id, chamando o model
    public function getProduct($id)
    {
        return $this->model->getProductById($id);
    }

    // Método para inserir um produto (usado no finalizarPagamento.php)
    public function addProduct($name, $price, $image)
    {
        return $this->model->addProduct($name, $price, $image);
    }
}
