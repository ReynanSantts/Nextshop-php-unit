<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trocar Email - NextShop</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../templates/assets/css/style.css" />
</head>
<body class="bg-dark text-light d-flex justify-content-center align-items-center vh-100 vw-100">
    <div class="card p-4" style="max-width: 400px; width: 100%;">
        <h3 class="mb-4 text-center">Trocar Email</h3>
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form action="#" method="post" novalidate>
            <div class="mb-3">
                <label for="newEmail" class="form-label">Digite outro email</label>
                <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="email@exemplo.com" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Emails salvos</label>
                <ul class="list-group">
                    <?php if (!empty($emails)): ?>
                        <?php foreach ($emails as $email): ?>
                            <li class="list-group-item bg-secondary text-light"><?php echo htmlspecialchars($email); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item bg-secondary text-light">Nenhum email salvo.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <button type="submit" class="btn btn-success w-100">Confirmar</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
