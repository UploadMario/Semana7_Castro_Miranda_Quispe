<?php
class Usuario {
    private PDO $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function buscarPorUsuario(string $usuario): ?array {
        $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ? LIMIT 1');
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function listar(): array {
        return $this->db->query('SELECT id, usuario, rol FROM usuarios ORDER BY id DESC')->fetchAll();
    }

    public function crear(array $data): bool {
        $sql = 'INSERT INTO usuarios (usuario, clave, rol) VALUES (:usuario, :clave, :rol)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':usuario' => trim($data['usuario']),
            ':clave' => password_hash($data['clave'], PASSWORD_BCRYPT),
            ':rol' => $data['rol'] ?? 'usuario',
        ]);
    }
}
