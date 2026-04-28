<?php
// ESTE ARCHIVO ES EL LAYOUT GLOBAL
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fiscalía Flagrancia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- 🔵 NAVBAR GLOBAL -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Sistema Fiscalía</span>

        <div>
            <a href="index.php" class="btn btn-light btn-sm">Inicio</a>
            <a href="index.php?view=form" class="btn btn-primary btn-sm">Nueva Carpeta</a>
            <a href="index.php?view=listar" class="btn btn-success btn-sm">Listado</a>
            <a href="index.php?action=csv" class="btn btn-info btn-sm">CSV</a>
            <a href="index.php?action=logout" class="btn btn-danger btn-sm">Salir</a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <!-- 🔥 AQUÍ SE CARGAN LAS VISTAS -->
    <?php include $contenido; ?>

</div>

</body>
</html>