<?php
session_start();

require_once '../vendor/autoload.php';
use Controller\ControllerUserR;

$userName = 'Usuário Anônimo';
$userEmail = 'email@exemplo.com';

// Se veio email via GET, busca no banco
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $userController = new ControllerUserR();
    $user = $userController->checkUserByEmail($_GET['email']);

    if ($user) {
        $userName = $user['user_name'];   // ajuste para o nome do campo no seu banco
        $userEmail = $user['user_email']; // ajuste para o nome do campo no seu banco
    }
} elseif (isset($_SESSION['registered_name'], $_SESSION['registered_email'])) {
    // Se veio da tela de cadastro, usa os dados da sessão
    $userName = $_SESSION['registered_name'];
    $userEmail = $_SESSION['registered_email'];
    unset($_SESSION['registered_name'], $_SESSION['registered_email']);
}

// Mascarar email
$emailParts = explode('@', $userEmail);
$maskedEmail = isset($emailParts[1])
    ? substr($emailParts[0], 0, 2) . str_repeat('*', max(0, strlen($emailParts[0]) - 2)) . '@' . $emailParts[1]
    : $userEmail;
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>NextShop - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../templates/assets/css/paginaLogin.css" />
    <!-- Ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
<body>
        <button class="back-btn" onclick="window.location.href='../register.php'">&#8592;</button>
    
    <div class="d-flex flex-column justify-content-center align-items-center vh-100 vw-100 text-light">
        <!-- Logo maior, nome já incluso na imagem -->
        <div class="mb-5 text-center">
            <img src="../templates/images/LogoNextShop.png" alt="Logo NextShop" class="logo-img logo-img-large" />
        </div>

        <!-- Caixa de email do usuário -->
        <div class="user-email-box d-flex align-items-center border rounded p-3 mb-4 w-100" style="max-width: 480px;">
            <!-- Avatar anônimo -->
            <div class="avatar me-3 d-flex justify-content-center align-items-center bg-secondary text-light" style="width:48px; height:48px; border-radius:50%; border: 2px solid #00ff00; font-weight: bold; font-size: 1.5rem;">
                ?
            </div>
            <div class="flex-grow-1">
                <!-- Nome do usuário dinâmico -->
                <div class="user-name" id="userName"><?php echo htmlspecialchars($userName ?? 'Usuário Anônimo'); ?></div>
                <!-- Email do usuário com parte oculta -->
                <div class="user-email" id="userEmail">
                    <span class="masked-email"><?php echo htmlspecialchars($maskedEmail ?? '******'); ?></span>
                </div>
                <!-- Input para trocar email, oculto inicialmente -->
                <input type="email" id="emailInput" class="form-control mt-2 d-none" placeholder="Digite outro email" aria-label="Trocar email" />
            </div>
            <!-- Link Trocar para abrir página de troca de email -->
            <a href="../register.php" id="switchEmail" class="text-success fw-bold ms-3 text-decoration-none">Trocar</a>
        </div>

        <!-- Input de senha -->
        <form class="w-100" style="max-width: 480px;" action="#" method="post" novalidate>
            <div class="input-group mb-3 password-group">
                <span class="input-group-text bg-secondary text-light border-0">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" name="password" id="password" class="form-control bg-secondary text-light border-0" placeholder="Digite sua senha" aria-label="Senha" required />
                <button class="btn btn-outline-success border-0" type="button" id="togglePassword" aria-label="Mostrar senha">
                    <i class="bi bi-eye-slash-fill"></i>
                </button>
            </div>

            <div class="d-flex justify-content-between mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberPassword" name="rememberPassword" />
                    <label class="form-check-label" for="rememberPassword">Lembrar a senha</label>
                </div>
                <div>
                    Esqueceu sua senha? <a href="#" class="text-success text-decoration-none">Clique aqui</a>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 py-3 fw-bold fs-5 text-uppercase">ENTRAR</button>
        </form>

        <!-- Texto inferior -->
        <div class="mt-5 text-center text-light">
            Ainda não tem uma conta? <a href="registerInfo.php" class="text-success text-decoration-none">Cadastre-se</a>
        </div>
    </div>
</body>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS personalizado -->
    <script src="../templates/js/script.js"></script>
    <script src="../templates/assets/js/script.js"></script>
</body>
</html>
