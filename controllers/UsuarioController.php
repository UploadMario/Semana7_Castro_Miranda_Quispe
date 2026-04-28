<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    public function listar(PDO $conexion): array {
        return (new Usuario($conexion))->listar();
    }

    public function crear(PDO $conexion): void {
        if (($_SESSION['user']['rol'] ?? '') !== 'admin') {
            $_SESSION['error'] = 'Acceso restringido.';
            header('Location: index.php');
            exit;
        }

        $usuario = trim($_POST['usuario'] ?? '');
        $clave = $_POST['clave'] ?? '';
        if ($usuario === '' || $clave === '') {
            $_SESSION['error'] = 'Usuario y contraseña son obligatorios.';
            header('Location: index.php?view=usuarios');
            exit;
        }

        (new Usuario($conexion))->crear($_POST);
        $_SESSION['success'] = 'Usuario creado correctamente.';
        header('Location: index.php?view=usuarios');
        exit;
    }
}
