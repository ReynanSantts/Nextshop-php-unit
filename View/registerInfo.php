<?php
// BUSCANDO E CARREGANDO O ARQUIVO AUTOLOAD
require_once '../vendor/autoload.php';

// IMPORTANDO O USERCONTROLLER
use Controller\ControllerUser;

$userController = new ControllerUser();

$registerUserMessage = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['user_name'], $_POST['user_email'],$_POST['user_cpf'], $_POST['user_password'])) {
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_cpf = $_POST['user_cpf'];
        $user_password = $_POST['user_password'];

        // USO DO CONTROLLER PARA VERIFICAÇÃO DE E-MAIL E CADASTRO DE USUÁRIO
        
        // JÁ EXISTE UM E-MAIL CADASTRADO?
        if($userController->checkUserByEmail($user_email)) {
            $registerUserMessage = "Já existe um usuário cadastrado com esse endereço de e-mail.";
        } else {
            // SE O E-MAIL JÁ EXISTE, CRIE O USUÁRIO
            if($userController->createUser($user_name, $user_email, $user_cpf, $user_password)) {
                // REDIRECIONAR PARA UMA OUTRA PÁGINA, QUANDO O USUÁRIO FOR CADASTRADO
                header('Location: ../View/paginaLogin.php');
                exit();
            } else {
                $registerUserMessage = 'Erro ao registrar informações.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/assets/css/paginaRegisterInfo.css">
    <title>Página dos inputs Registrar</title>
</head>
<body>
    <div class="register-container">
        <button class="back-btn" onclick="window.location.href='../register.php'">&#8592;</button>
        <div class="form-content">
            <h2>CRIAR CONTA</h2>
            <p class="subtitle">O primeiro passo pra abrir sua conta é<br>informar uns dados ;)</p>
            <form method="POST">
                <input id="userName" name="user_name" type="text" placeholder="Nome Completo" required>
                <input id="userEmail" name="user_email" type="email" placeholder="E-mail" required>
                <input id="userCpf" name="user_cpf" type="text" placeholder="CPF" required>
                <input id="userPassword" name="user_password" type="password" placeholder="Senha" required>
                <input id="userConfirmPassword" name="userConfirmPassword" type="password" placeholder="Confirmar senha" required>
                <button type="submit"  class="btn-continuar">Continuar</button>
            </form>
        </div>
    </div>
</body>
</html>