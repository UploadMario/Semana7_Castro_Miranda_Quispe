<?php
class Usuario {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function buscar($usuario){
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario=?");
        $stmt->execute([$usuario]);
        return $stmt->fetch();
    }
}