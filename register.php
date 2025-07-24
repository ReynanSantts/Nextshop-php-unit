<?php
session_start();

require_once 'vendor/autoload.php'; // ajuste o caminho se necessário
use Controller\ControllerUserR;



// Se veio email via GET, busca no banco
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $userEmail = $_GET['email'];
    $userController = new ControllerUserR();
    $user = $userController->getFirstUser();
    $user = $userController->checkUserByEmail($userEmail); // Você precisa ter esse método no controller

    if ($user) {
    $userName = $user['user_name'];   // ajuste para o nome do campo no seu banco
    $userEmail = $user['user_email']; // ajuste para o nome do campo no seu banco
} else {
    $userName = 'Usuário Anônimo';
    $userEmail = 'email@exemplo.com';
}
}

// Mascarar email
if (!isset($userEmail)) {
    $userEmail = 'email@exemplo.com';
}
$emailParts = explode('@', $userEmail);
$maskedEmail = isset($emailParts[1])
    ? substr($emailParts[0], 0, 2) . str_repeat('*', max(0, strlen($emailParts[0]) - 2)) . '@' . $emailParts[1]
    : $userEmail;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="templates/assets/css/paginaRegister.css">
</head>
<body>
    <div class="container">
        <div class="logo-area">
            <img src="templates/images/logoNextShop.png" alt="NextShop Logo" class="logo-img">
        </div>
        <div class="left-area">
            <p class="slogan">
                NextShop,<br>
                conectando<br>
                negócios e pessoas
            </p>
            <span class="highlight">o próximo é você</span>
        </div>
<div class="buttons-area">
    <button type="button" class="btn-login" id="showEmailInput">JÁ TENHO CONTA</button>
    <form action="View/paginaLogin.php" method="get" id="emailForm" style="display:none; margin-top:10px;">
    <div class="input-group">
        <input type="email" name="email" class="form-control" placeholder="Digite seu email" required>
        <button type="submit" class="btn btn-success">Entrar</button>
        <button type="button" class="btn btn-secondary" id="cancelEmailInput">Cancelar</button>
    </div>
</form>
    <button class="btn-registrar" id="btnCriarConta" onclick="window.location.href='View/registerInfo.php'">CRIAR CONTA</button>
</div>
<script src="templates/js/register.js"></script>
    </div>
</body>
</html>