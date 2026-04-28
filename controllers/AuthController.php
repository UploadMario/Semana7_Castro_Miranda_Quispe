<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    public function login(PDO $conexion): void {
        $usuario = trim($_POST['usuario'] ?? '');
        $clave = $_POST['clave'] ?? '';

        if ($usuario === '' || $clave === '') {
            $_SESSION['error'] = 'Ingrese usuario y contraseña.';
            header('Location: index.php');
            exit;
        }

        $model = new Usuario($conexion);
        $user = $model->buscarPorUsuario($usuario);

        if ($user && password_verify($clave, $user['clave'])) {
            unset($user['clave']);
            $_SESSION['user'] = $user;
            header('Location: index.php');
            exit;
        }

        $_SESSION['error'] = 'Credenciales incorrectas.';
        header('Location: index.php');
        exit;
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
