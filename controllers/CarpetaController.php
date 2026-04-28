<?php
require_once "../models/Carpeta.php";

class CarpetaController {

    public function guardar($conexion){
        $model = new Carpeta($conexion);

        $model->insertar([
            $_POST['nro_carpeta'],
            $_POST['denunciante'],
            $_POST['agraviado'],
            $_POST['delito'],
            $_POST['fecha_hecho'],
            $_POST['fiscal_responsable'],
            $_POST['fiscalia'],
            $_POST['estado']
        ]);

        header("Location: index.php?view=listar");
    }

    public function listar($conexion){
        return (new Carpeta($conexion))->listar();
    }

    public function dashboard($conexion){

    // TOTAL POR ESTADO
    $archivados = $conexion->query("SELECT COUNT(*) FROM carpetas WHERE estado='archivado'")->fetchColumn();

    $formalizados = $conexion->query("SELECT COUNT(*) FROM carpetas WHERE estado='formalizado'")->fetchColumn();

    // POR FISCALIA
    $stmt = $conexion->query("SELECT fiscalia, COUNT(*) total FROM carpetas GROUP BY fiscalia");

    $labels = [];
    $data = [];

    foreach($stmt as $row){
        $labels[] = $row['fiscalia'];
        $data[] = $row['total'];
    }

    return [
        'archivados' => $archivados,
        'formalizados' => $formalizados,
        'labels' => $labels,
        'data' => $data
    ];
    }
}