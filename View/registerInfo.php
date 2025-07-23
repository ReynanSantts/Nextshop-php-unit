<?php
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paginaRegisterInfo.css">
    <title>Página dos inputs Registrar</title>
</head>
<body>
    <div class="register-container">
        <button class="back-btn" onclick="window.location.href='register.php'">&#8592;</button>
        <div class="form-content">
            <h2>CRIAR CONTA</h2>
            <p class="subtitle">O primeiro passo pra abrir sua conta é<br>informar uns dados ;)</p>
            <form>
                <input type="text" placeholder="Nome Completo" required>
                <input type="email" placeholder="E-mail" required>
                <input type="text" placeholder="CPF" required>
                <input type="password" placeholder="Senha" required>
                <input type="password" placeholder="Confirmar senha" required>
                <button type="submit" class="btn-continuar">Continuar</button>
            </form>
        </div>
    </div>
</body>
</html>