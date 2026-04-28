<?php
require_once "../models/Usuario.php";

class AuthController {

    public function login($conexion){
        $model = new Usuario($conexion);
        $user = $model->buscar($_POST['usuario']);

        if($user && password_verify($_POST['clave'], $user['clave'])){
            $_SESSION['user'] = $user;
            header("Location: index.php");
        } else {
            echo "Credenciales incorrectas";
        }
    }

    public function logout(){
        session_destroy();
        header("Location: index.php");
    }
}