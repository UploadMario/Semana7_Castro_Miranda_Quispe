<?php
require_once __DIR__ . '/../models/Carpeta.php';

class ReporteController {
    public function exportarCsv($conexion){

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=reporte_carpetas.csv');

        $f = fopen('php://output', 'w');

        fputcsv($f, ['REPORTE DE CASOS DE FLAGRANCIA']);

        fputcsv($f, []);

        fputcsv($f, [
            'Fiscal Responsable',
            'Fiscalía',
            'Despacho',
            'N° Carpeta',
            'Fecha',
            'Delito',
            'Proceso',
            'Formalización',
            'PP Fundado',
            'PP Infundado',
            'Comparecencia Fundado',
            'Comparecencia Infundado',
            'Sentencia Efectiva',
            'Sentencia Suspendida',
            'Estado'
        ]);

        $sql = "SELECT * FROM carpetas ORDER BY fecha DESC";
        $stmt = $conexion->query($sql);

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            $fecha = $row['fecha'] ? date('d/m/Y', strtotime($row['fecha'])) : '';

            $proceso = $row['proceso_inmediato'] ?: '-';
            $formalizacion = $row['formalizacion'] ?: '-';

            $ppFundado = $row['prision_preventiva_fundado_plazo'] ?: '-';
            $ppInfundado = $row['prision_preventiva_infundado'] ?: '-';

            $compFundado = $row['comparecencia_fundado_plazo'] ?: '-';
            $compInfundado = $row['comparecencia_infundado'] ?: '-';

            $sentEfectiva = $row['sentencia_efectiva'] ?: '-';
            $sentSuspendida = $row['sentencia_suspendida'] ?: '-';

            fputcsv($f, [
                $row['fiscal_responsable'] ?: '-',
                $row['fiscalia'] ?: '-',
                $row['despacho'] ?: '-',
                $row['nro_carpeta'] ?: '-',
                $fecha,
                $row['delito'] ?: '-',
                $proceso,
                $formalizacion,
                $ppFundado,
                $ppInfundado,
                $compFundado,
                $compInfundado,
                $sentEfectiva,
                $sentSuspendida,
                $row['estado'] ?: '-'
            ]);
        }

        fclose($f);
        exit;
    }
}


