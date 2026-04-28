<?php
require_once __DIR__ . '/../models/Carpeta.php';

class CarpetaController {
    public function guardar(PDO $conexion): void {
        $errores = $this->validar($_POST);
        if ($errores) {
            $_SESSION['errores'] = $errores;
            $_SESSION['old'] = $_POST;
            header('Location: index.php?view=form');
            exit;
        }

        (new Carpeta($conexion))->insertar($_POST);
        $_SESSION['success'] = 'Carpeta registrada correctamente.';
        header('Location: index.php?view=listar');
        exit;
    }

    public function actualizar(PDO $conexion): void {
        $id = (int)($_POST['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['error'] = 'Registro no válido.';
            header('Location: index.php?view=listar');
            exit;
        }

        $errores = $this->validar($_POST);
        if ($errores) {
            $_SESSION['errores'] = $errores;
            $_SESSION['old'] = $_POST;
            header('Location: index.php?view=form&id=' . $id);
            exit;
        }

        (new Carpeta($conexion))->actualizar($id, $_POST);
        $_SESSION['success'] = 'Carpeta actualizada correctamente.';
        header('Location: index.php?view=listar');
        exit;
    }

    public function eliminar(PDO $conexion): void {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            (new Carpeta($conexion))->eliminar($id);
            $_SESSION['success'] = 'Carpeta eliminada correctamente.';
        }
        header('Location: index.php?view=listar');
        exit;
    }

    public function listar(PDO $conexion, array $filtros = []): array {
        return (new Carpeta($conexion))->listar($filtros);
    }

    public function buscar(PDO $conexion, int $id): ?array {
        return (new Carpeta($conexion))->buscarPorId($id);
    }

    public function dashboard(PDO $conexion): array {
        return (new Carpeta($conexion))->dashboard();
    }

    private function validar(array $data): array {
        $errores = [];
        $obligatorios = [
            'nro_carpeta' => 'N° de carpeta',
            'fecha' => 'Fecha',
            'delito' => 'Delito',
            'fiscal_responsable' => 'Fiscal responsable',
            'fiscalia' => 'Fiscalía',
            'estado' => 'Estado'
        ];

        foreach ($obligatorios as $campo => $label) {
            if (trim($data[$campo] ?? '') === '') {
                $errores[] = "El campo {$label} es obligatorio.";
            }
        }

        return $errores;
    }
}
