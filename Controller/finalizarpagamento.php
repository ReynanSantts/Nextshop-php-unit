<?php
// finalizarPagamento.php

require_once '../vendor/autoload.php'; // Carrega automaticamente as classes via Composer (autoload)

use Controller\ControllerProduct; // Usa a classe ControllerProduct do namespace Controller

header('Content-Type: application/json'); // Define que a resposta será JSON

try {
    // Cria a conexão PDO com o banco 'nextshop', usando UTF-8 e usuário root sem senha
    $pdo = new PDO('mysql:host=localhost;dbname=nextshop;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configura PDO para lançar exceções em erros

    $controller = new ControllerProduct($pdo); // Instancia o controller passando a conexão PDO

    // Lê o corpo da requisição (espera um JSON)
    $json = file_get_contents('php://input');
    // Decodifica o JSON para array associativo
    $data = json_decode($json, true);

    // Verifica se o array 'items' existe, é array e tem pelo menos 1 item
    if (!isset($data['items']) || !is_array($data['items']) || count($data['items']) === 0) {
        // Responde JSON indicando falha e mensagem específica
        echo json_encode(['success' => false, 'message' => 'Nenhum item no carrinho']);
        exit; // Encerra a execução do script
    }

    // Para cada item do carrinho recebido
    foreach ($data['items'] as $item) {
        // Extrai valores com fallback caso não existam
        $name = $item['name'] ?? '';
        $price = $item['price'] ?? 0;
        $image = $item['image'] ?? '';

        // Só tenta adicionar se nome não vazio e preço maior que zero
        if ($name !== '' && $price > 0) {
            // Chama método para adicionar produto (deve existir no ControllerProduct)
            $controller->addProduct($name, $price, $image);
        }
    }

    // Retorna JSON indicando sucesso
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Em caso de erro, retorna JSON com sucesso falso e mensagem de erro
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
