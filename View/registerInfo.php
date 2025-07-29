<?php
// BUSCANDO E CARREGANDO O ARQUIVO AUTOLOAD
require_once '../vendor/autoload.php'; // Carrega classes automaticamente via Composer

// IMPORTANDO OS CONTROLLERS
use Controller\ControllerUser;
use Controller\ControllerUserR;

$userController = new ControllerUserR(); // Instancia o controller responsável pelo registro

$registerUserMessage = ''; // Variável para mensagens de sucesso/erro no cadastro

// Se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos necessários foram enviados
    if (isset($_POST['user_name'], $_POST['user_email'], $_POST['user_cpf'], $_POST['user_password'])) {
        // Recebe os dados do formulário
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_cpf = $_POST['user_cpf'];
        $user_password = $_POST['user_password'];

        // Verifica se já existe um usuário cadastrado com esse email
        if ($userController->checkUserByEmail($user_email)) {
            $registerUserMessage = "Já existe um usuário cadastrado com esse endereço de e-mail.";
        } else {
            // Se email não existe, tenta criar um novo usuário
            if ($userController->createUser($user_name, $user_email, $user_cpf, $user_password)) {
                // Se cadastro foi sucesso, inicia a sessão
                session_start();
                $_SESSION['user_id'] = $newUser['user_id']; // Salva o ID do usuário na sessão (atenção: $newUser não definido aqui!)
                $_SESSION['registered_name'] = $user_name; // Salva nome na sessão
                $_SESSION['registered_email'] = $user_email; // Salva email na sessão

                // Redireciona para página de login após cadastro
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
                <input id="userConfirmPassword" name="userConfirmPassword" type="password" placeholder="Confirmar senha"
                    required>
                <button type="submit" class="btn-continuar">Continuar</button>
            </form>
        </div>
    </div>
</body>

</html>