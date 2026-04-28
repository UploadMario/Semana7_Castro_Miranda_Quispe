<?php
class Carpeta {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function insertar($data){
        $sql = "INSERT INTO carpetas VALUES(NULL,?,?,?,?,?,?,?,?)";
        $this->db->prepare($sql)->execute($data);
    }

    public function listar(){
        return $this->db->query("SELECT * FROM carpetas")->fetchAll();
    }
}