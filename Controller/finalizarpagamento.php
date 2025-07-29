<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// finalizarPagamento.php

require_once '../vendor/autoload.php';

use Controller\ControllerProduct;

header('Content-Type: application/json');


try {
    $pdo = new PDO('mysql:host=localhost;dbname=nextshop;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $controller = new ControllerProduct($pdo);

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!isset($data['items']) || !is_array($data['items']) || count($data['items']) === 0) {
        echo json_encode(['success' => false, 'message' => 'Nenhum item no carrinho']);
        exit;
    }

    foreach ($data['items'] as $item) {
        $name = $item['name'] ?? '';
        $price = $item['price'] ?? 0;
        $image = $item['image'] ?? '';

        if ($name !== '' && $price > 0) {
            $controller->addProduct($name, $price, $image);  // precisa ter esse método no controller
        }
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;
}
