<?php
// Arquivo principal que redireciona para a view de login

// Incluir controlador e iniciar sessão se necessário
require_once __DIR__ . '/controller/UserController.php';

// Aqui poderia iniciar sessão, verificar login, etc.

// Redireciona para a view de login
header('Location: view/index.php');
exit;
?>
