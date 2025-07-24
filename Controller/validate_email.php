<?php
session_start();
require_once '../vendor/autoload.php';

use Controller\ControllerUserR;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Email não fornecido']);
        exit;
    }

    $userController = new ControllerUserR();
    $user = $userController->checkUserByEmail($email);

    if ($user) {
        // Atualiza a sessão com o novo email e nome
        $_SESSION['registered_email'] = $user['user_email'];
        $_SESSION['registered_name'] = $user['user_name'];

        echo json_encode([
            'success' => true,
            'user_name' => $user['user_name'],
            'user_email' => $user['user_email']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Email não encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método inválido']);
}
