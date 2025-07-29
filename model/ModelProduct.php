<?php
namespace Model;

use PDO;

class ModelProduct
{
    private $pdo; // Propriedade privada para armazenar a conexão PDO

    // Construtor recebe a conexão PDO e armazena na propriedade $pdo
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Buscar todos os produtos da tabela 'produtos', ordenando pelo id ascendente
    public function getAllProducts()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos ORDER BY id ASC"); // Prepara a consulta SQL
        $stmt->execute(); // Executa a consulta
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos os resultados em formato array associativo
    }

    // Buscar um produto específico pelo id
    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id LIMIT 1"); // Consulta com placeholder :id
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Liga o valor do id passado como inteiro
        $stmt->execute(); // Executa a consulta
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna o produto encontrado (ou false se não achar)
    }

    // Inserir um novo produto com nome, preço e imagem
    public function addProduct($name, $price, $image)
    {
        $stmt = $this->pdo->prepare("INSERT INTO produtos (name, price, image) VALUES (:name, :price, :image)"); // Prepara INSERT
        $stmt->bindValue(':name', $name); // Liga o nome ao placeholder
        $stmt->bindValue(':price', $price); // Liga o preço
        $stmt->bindValue(':image', $image); // Liga a imagem
        return $stmt->execute(); // Executa o insert e retorna true se sucesso
    }

    // Atualizar produto existente pelo id, alterando nome, preço e imagem
    public function updateProduct($id, $name, $price, $image)
    {
        $stmt = $this->pdo->prepare("UPDATE produtos SET name = :name, price = :price, image = :image WHERE id = :id"); // Prepara UPDATE
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Liga id
        $stmt->bindValue(':name', $name); // Liga nome
        $stmt->bindValue(':price', $price); // Liga preço
        $stmt->bindValue(':image', $image); // Liga imagem
        return $stmt->execute(); // Executa e retorna sucesso/falha
    }

    // Deletar produto pelo id
    public function deleteProduct($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id"); // Prepara DELETE
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Liga id
        return $stmt->execute(); // Executa e retorna sucesso/falha
    }

    // ✅ NOVO MÉTODO: Salvar vários produtos comprados (ex: no checkout)
    // Recebe array de itens, insere um por um na tabela produtos
    public function savePurchasedProducts(array $items): bool
    {
        try {
            $sql = "INSERT INTO produtos (name, price, image) VALUES (:name, :price, :image)";
            $stmt = $this->pdo->prepare($sql);

            // Loop para inserir cada item do array
            foreach ($items as $item) {
                $stmt->bindParam(':name', $item['name'], PDO::PARAM_STR); // Liga nome (por referência)
                $stmt->bindParam(':price', $item['price']); // Liga preço
                $stmt->bindParam(':image', $item['image'], PDO::PARAM_STR); // Liga imagem
                $stmt->execute(); // Executa a inserção
            }

            return true; // Sucesso
        } catch (\PDOException $e) {
            // Em caso de erro, grava no log e retorna false
            error_log("Erro ao salvar produtos: " . $e->getMessage());
            return false;
        }
    }
}
?>
