<?php
$user = $_SESSION['user'] ?? null;
function e($value){ return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function active($name, $view){ return $name === $view ? 'active' : ''; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo ?? 'Sistema Fiscalía') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="index.php">Fiscalía Flagrancia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSistema">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSistema">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?= active('dashboard', $view ?? '') ?>" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?= active('listar', $view ?? '') ?>" href="index.php?view=listar">Carpetas</a></li>
                <li class="nav-item"><a class="nav-link <?= active('form', $view ?? '') ?>" href="index.php?view=form">Nueva carpeta</a></li>
                <li class="nav-item"><a class="nav-link <?= active('reportes', $view ?? '') ?>" href="index.php?view=reportes">Reportes</a></li>
                <?php if (($user['rol'] ?? '') === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link <?= active('usuarios', $view ?? '') ?>" href="index.php?view=usuarios">Usuarios</a></li>
                <?php endif; ?>
            </ul>
            <span class="navbar-text me-3 small">Usuario: <?= e($user['usuario'] ?? '') ?></span>
            <a class="btn btn-outline-light btn-sm" href="index.php?action=logout">Salir</a>
        </div>
    </div>
</nav>

<main class="container-fluid px-4 py-4">
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= e($_SESSION['success']); unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= e($_SESSION['error']); unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php include $contenido; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
