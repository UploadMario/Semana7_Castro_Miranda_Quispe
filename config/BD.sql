CREATE DATABASE IF NOT EXISTS flagrancia_fiscalia
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE flagrancia_fiscalia;

CREATE TABLE IF NOT EXISTS carpetas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  fiscal_responsable VARCHAR(150) NOT NULL,
  fiscalia VARCHAR(150) NOT NULL,
  despacho VARCHAR(80) DEFAULT NULL,
  nro_carpeta VARCHAR(80) NOT NULL,
  fecha DATE DEFAULT NULL,
  delito VARCHAR(180) NOT NULL,
  proceso_inmediato VARCHAR(100) DEFAULT NULL,
  formalizacion VARCHAR(100) DEFAULT NULL,
  prision_preventiva_fundado_plazo VARCHAR(120) DEFAULT NULL,
  prision_preventiva_infundado VARCHAR(120) DEFAULT NULL,
  comparecencia_fundado_plazo VARCHAR(120) DEFAULT NULL,
  comparecencia_infundado VARCHAR(120) DEFAULT NULL,
  sentencia_efectiva VARCHAR(120) DEFAULT NULL,
  sentencia_suspendida VARCHAR(120) DEFAULT NULL,
  estado VARCHAR(30) NOT NULL DEFAULT 'formalizado',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  clave VARCHAR(255) NOT NULL,
  rol VARCHAR(20) NOT NULL DEFAULT 'usuario',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios (usuario, clave, rol)
SELECT 'admin', '$2y$10$k/sX10Q3fMsGVh6hi594JODfoArD5H3E/C/Mv6BR9vAgTDrgdW6zS', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM usuarios WHERE usuario = 'admin');
