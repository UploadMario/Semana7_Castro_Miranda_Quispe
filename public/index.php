<?php
session_start();

require_once "../config/database.php";
require_once "../controllers/AuthController.php";
require_once "../controllers/CarpetaController.php";

$action = $_GET['action'] ?? null;
$view = $_GET['view'] ?? null;

// ACCIONES
if($action=="login"){
    (new AuthController())->login($conexion);
}
elseif($action=="logout"){
    (new AuthController())->logout();
}
elseif($action=="guardar"){
    (new CarpetaController())->guardar($conexion);
}
elseif($action=="csv"){
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=reportes.csv');

    $f=fopen('php://output','w');
    foreach($conexion->query("SELECT fiscalia,COUNT(*) total FROM carpetas GROUP BY fiscalia") as $row){
        fputcsv($f,$row);
    }
    fclose($f);
    exit;
}
else{

    if(!isset($_SESSION['user'])){
        include "../views/login.php";
        exit;
    }

    // 🔥 DEFINIR VISTA
    if($view=="form"){
        $contenido = "../views/carpeta_form.php";
    }
    elseif($view=="listar"){
        $data = (new CarpetaController())->listar($conexion);
        $contenido = "../views/carpeta_list.php";
    }
    else{
        $ctrl = new CarpetaController();
        $stats = $ctrl->dashboard($conexion);

        $archivados = $stats['archivados'];
        $formalizados = $stats['formalizados'];
        $fiscalias_labels = $stats['labels'];
        $fiscalias_data = $stats['data'];

        $contenido = "../views/dashboard.php";
    }

    // 🔥 CARGAR LAYOUT GLOBAL
    include "../views/layout/main.php";
}