<?php
class Carpeta {
    private PDO $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function insertar(array $data): bool {
        $sql = 'INSERT INTO carpetas (
            fiscal_responsable, fiscalia, despacho, nro_carpeta, fecha, delito,
            proceso_inmediato, formalizacion,
            prision_preventiva_fundado_plazo, prision_preventiva_infundado,
            comparecencia_fundado_plazo, comparecencia_infundado,
            sentencia_efectiva, sentencia_suspendida, estado
        ) VALUES (
            :fiscal_responsable, :fiscalia, :despacho, :nro_carpeta, :fecha, :delito,
            :proceso_inmediato, :formalizacion,
            :prision_preventiva_fundado_plazo, :prision_preventiva_infundado,
            :comparecencia_fundado_plazo, :comparecencia_infundado,
            :sentencia_efectiva, :sentencia_suspendida, :estado
        )';

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($this->normalizar($data));
    }

    public function listar(array $filtros = []): array {
        $where = [];
        $params = [];

        if (!empty($filtros['q'])) {
            $where[] = '(nro_carpeta LIKE :q OR fiscal_responsable LIKE :q OR fiscalia LIKE :q OR delito LIKE :q)';
            $params[':q'] = '%' . trim($filtros['q']) . '%';
        }

        if (!empty($filtros['estado'])) {
            $where[] = 'estado = :estado';
            $params[':estado'] = $filtros['estado'];
        }

        if (!empty($filtros['fiscalia'])) {
            $where[] = 'fiscalia LIKE :fiscalia';
            $params[':fiscalia'] = '%' . trim($filtros['fiscalia']) . '%';
        }

        $sql = 'SELECT * FROM carpetas';
        if ($where) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY fecha DESC, id DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $stmt = $this->db->prepare('SELECT * FROM carpetas WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function actualizar(int $id, array $data): bool {
        $sql = 'UPDATE carpetas SET
            fiscal_responsable = :fiscal_responsable,
            fiscalia = :fiscalia,
            despacho = :despacho,
            nro_carpeta = :nro_carpeta,
            fecha = :fecha,
            delito = :delito,
            proceso_inmediato = :proceso_inmediato,
            formalizacion = :formalizacion,
            prision_preventiva_fundado_plazo = :prision_preventiva_fundado_plazo,
            prision_preventiva_infundado = :prision_preventiva_infundado,
            comparecencia_fundado_plazo = :comparecencia_fundado_plazo,
            comparecencia_infundado = :comparecencia_infundado,
            sentencia_efectiva = :sentencia_efectiva,
            sentencia_suspendida = :sentencia_suspendida,
            estado = :estado
            WHERE id = :id';

        $params = $this->normalizar($data);
        $params[':id'] = $id;
        return $this->db->prepare($sql)->execute($params);
    }

    public function eliminar(int $id): bool {
        return $this->db->prepare('DELETE FROM carpetas WHERE id = ?')->execute([$id]);
    }

    public function dashboard(): array {
        $total = (int)$this->db->query('SELECT COUNT(*) FROM carpetas')->fetchColumn();
        $archivados = (int)$this->db->query("SELECT COUNT(*) FROM carpetas WHERE estado = 'archivado'")->fetchColumn();
        $formalizados = (int)$this->db->query("SELECT COUNT(*) FROM carpetas WHERE estado = 'formalizado'")->fetchColumn();
        $sentenciados = (int)$this->db->query("SELECT COUNT(*) FROM carpetas WHERE estado = 'sentenciado'")->fetchColumn();

        $porFiscalia = $this->db->query('SELECT COALESCE(NULLIF(fiscalia, ""), "Sin fiscalía") fiscalia, COUNT(*) total FROM carpetas GROUP BY fiscalia ORDER BY total DESC')->fetchAll();
        $porDelito = $this->db->query('SELECT COALESCE(NULLIF(delito, ""), "Sin delito") delito, COUNT(*) total FROM carpetas GROUP BY delito ORDER BY total DESC LIMIT 5')->fetchAll();

        return compact('total', 'archivados', 'formalizados', 'sentenciados', 'porFiscalia', 'porDelito');
    }

    private function normalizar(array $data): array {
        $campos = [
            'fiscal_responsable', 'fiscalia', 'despacho', 'nro_carpeta', 'fecha', 'delito',
            'proceso_inmediato', 'formalizacion',
            'prision_preventiva_fundado_plazo', 'prision_preventiva_infundado',
            'comparecencia_fundado_plazo', 'comparecencia_infundado',
            'sentencia_efectiva', 'sentencia_suspendida', 'estado'
        ];

        $params = [];
        foreach ($campos as $campo) {
            $valor = $data[$campo] ?? null;
            $valor = is_string($valor) ? trim($valor) : $valor;
            if ($campo === 'fecha' && $valor === '') {
                $valor = null;
            }
            $params[':' . $campo] = $valor === '' ? null : $valor;
        }
        return $params;
    }
}
