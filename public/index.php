<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/CarpetaController.php';
require_once __DIR__ . '/../controllers/ReporteController.php';
require_once __DIR__ . '/../controllers/UsuarioController.php';

$action = $_GET['action'] ?? null;
$view = $_GET['view'] ?? 'dashboard';

if ($action === 'login') {
    (new AuthController())->login($conexion);
}

if ($action === 'logout') {
    (new AuthController())->logout();
}

if (!isset($_SESSION['user'])) {
    include __DIR__ . '/../views/login.php';
    exit;
}

switch ($action) {
    case 'guardar':
        (new CarpetaController())->guardar($conexion);
        break;
    case 'actualizar':
        (new CarpetaController())->actualizar($conexion);
        break;
    case 'eliminar':
        (new CarpetaController())->eliminar($conexion);
        break;
    case 'csv':
        (new ReporteController())->exportarCsv($conexion);
        break;
    case 'crearUsuario':
        (new UsuarioController())->crear($conexion);
        break;
}

$contenido = __DIR__ . '/../views/dashboard.php';
$titulo = 'Dashboard';
$ctrl = new CarpetaController();

switch ($view) {
    case 'form':
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $carpeta = $id > 0 ? $ctrl->buscar($conexion, $id) : null;
        $titulo = $carpeta ? 'Editar carpeta' : 'Nueva carpeta';
        $contenido = __DIR__ . '/../views/carpetas/form.php';
        break;

    case 'listar':
        $filtros = [
            'q' => $_GET['q'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'fiscalia' => $_GET['fiscalia'] ?? '',
        ];
        $data = $ctrl->listar($conexion, $filtros);
        $titulo = 'Listado de carpetas';
        $contenido = __DIR__ . '/../views/carpetas/list.php';
        break;

    case 'reportes':
        $stats = $ctrl->dashboard($conexion);
        $titulo = 'Reportes';
        $contenido = __DIR__ . '/../views/reportes/index.php';
        break;

    case 'usuarios':
        $usuarios = (new UsuarioController())->listar($conexion);
        $titulo = 'Usuarios';
        $contenido = __DIR__ . '/../views/usuarios/index.php';
        break;

    default:
        $stats = $ctrl->dashboard($conexion);
        $contenido = __DIR__ . '/../views/dashboard.php';
        break;
}

include __DIR__ . '/../views/layout/main.php';
