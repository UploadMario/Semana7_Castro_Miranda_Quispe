<?php function e($value){ return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fiscalía Flagrancia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="login-body">
<div class="login-card card shadow-sm">
    <div class="card-body p-4">
        <h1 class="h4 mb-1">Fiscalía Flagrancia</h1>
        <p class="text-muted mb-4">Ingrese sus credenciales para continuar</p>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger py-2"><?= e($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login" autocomplete="off">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="clave" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Ingresar</button>
        </form>
    </div>
</div>
</body>
</html>
