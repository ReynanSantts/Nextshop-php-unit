<?php
namespace Controller;

use Model\ModelProduct; // Usa a classe ModelProduct do namespace Model
use PDO;

class ControllerProduct
{
    private $model; // Propriedade para armazenar a instância do model

    // Construtor modificado para aceitar injeção do model
    public function __construct(PDO $pdo, ?ModelProduct $model = null)
    {
        $this->model = $model ?: new ModelProduct($pdo);
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
    public function addProduct($name, $price, $image, $qtd)
    {
        return $this->model->addProduct($name, $price, $image, $qtd);
    }
}
