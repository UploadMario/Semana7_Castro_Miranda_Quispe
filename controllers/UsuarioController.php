<?php
require_once "../models/Usuario.php";

class UsuarioController {
    public function crear($conexion){
        session_start();
        if($_SESSION['usuario']['rol']!='admin'){
            die("Acceso restringido");
        }

        $model = new Usuario($conexion);
        $model->crear($_POST);
        header("Location: index.php?view=usuarios");
    }
}