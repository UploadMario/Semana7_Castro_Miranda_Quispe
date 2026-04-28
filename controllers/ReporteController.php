<?php
require_once __DIR__ . '/../models/Carpeta.php';

class ReporteController {
    public function exportarCsv(PDO $conexion): void {
        $model = new Carpeta($conexion);
        $data = $model->listar($_GET);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=carpetas_fiscalia.csv');

        $f = fopen('php://output', 'w');
        fputcsv($f, [
            'ID', 'Fiscal responsable', 'Fiscalía', 'Despacho', 'N° carpeta', 'Fecha', 'Delito',
            'Proceso inmediato', 'Formalización', 'PP fundado/plazo', 'PP infundado',
            'Comparecencia fundado/plazo', 'Comparecencia infundado', 'Sentencia efectiva',
            'Sentencia suspendida', 'Estado'
        ]);

        foreach ($data as $row) {
            fputcsv($f, [
                $row['id'], $row['fiscal_responsable'], $row['fiscalia'], $row['despacho'],
                $row['nro_carpeta'], $row['fecha'], $row['delito'], $row['proceso_inmediato'],
                $row['formalizacion'], $row['prision_preventiva_fundado_plazo'],
                $row['prision_preventiva_infundado'], $row['comparecencia_fundado_plazo'],
                $row['comparecencia_infundado'], $row['sentencia_efectiva'],
                $row['sentencia_suspendida'], $row['estado']
            ]);
        }
        fclose($f);
        exit;
    }
}
