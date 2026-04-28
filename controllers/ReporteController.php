<?php
class ReporteController {
    private $db;

    public function __construct($conexion){
        $this->db = $conexion;
    }

    public function exportar(){
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=reportes.csv');

        $f = fopen('php://output','w');

        fputcsv($f,['Fiscalia','Total']);

        $sql = "SELECT fiscalia, COUNT(*) total FROM carpetas GROUP BY fiscalia";
        $data = $this->db->query($sql);

        foreach($data as $row){
            fputcsv($f,$row);
        }

        fclose($f);
    }
}