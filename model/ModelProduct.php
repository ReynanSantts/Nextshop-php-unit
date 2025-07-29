<?php
namespace Model;

use PDO;

class ModelProduct
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Buscar todos produtos
    public function getAllProducts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar produto por id
    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id LIMIT 1");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserir produto individualmente (exemplo)
    public function addProduct($name, $price, $image)
    {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (name, price, image) VALUES (:name, :price, :image)");
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image', $image);
        return $stmt->execute();
    }

    // Atualizar produto (exemplo)
    public function updateProduct($id, $name, $price, $image)
    {
        $stmt = $this->pdo->prepare("UPDATE produtos SET name = :name, price = :price, image = :image WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':price', $price);
        $stmt->bindValue(':image', $image);
        return $stmt->execute();
    }

    // Deletar produto (exemplo)
    public function deleteProduct($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // ✅ NOVO: Salvar produtos comprados via checkout
    public function savePurchasedProducts(array $items): bool
    {
        try {
            $sql = "INSERT INTO produtos (name, price, image) VALUES (:name, :price, :image)";
            $stmt = $this->pdo->prepare($sql);

            foreach ($items as $item) {
                $stmt->bindParam(':name', $item['name'], PDO::PARAM_STR);
                $stmt->bindParam(':price', $item['price']);
                $stmt->bindParam(':image', $item['image'], PDO::PARAM_STR);
                $stmt->execute();
            }

            return true;
        } catch (\PDOException $e) {
            error_log("Erro ao salvar produtos: " . $e->getMessage());
            return false;
        }
    }
}
?>