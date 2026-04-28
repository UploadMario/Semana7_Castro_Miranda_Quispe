-- Crear base de datos
CREATE DATABASE IF NOT EXISTS flagrancia_fiscalia;
USE flagrancia_fiscalia;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- =========================
-- TABLA: carpetas
-- =========================
CREATE DATABASE IF NOT EXISTS flagrancia_fiscalia;
USE flagrancia_fiscalia;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE carpetas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  fiscal_responsable VARCHAR(150) DEFAULT NULL,
  fiscalia VARCHAR(100) DEFAULT NULL,
  despacho VARCHAR(50) DEFAULT NULL,
  nro_carpeta VARCHAR(50) DEFAULT NULL,
  fecha DATE DEFAULT NULL,
  delito VARCHAR(150) DEFAULT NULL,
  proceso_inmediato VARCHAR(100) DEFAULT NULL,
  formalizacion VARCHAR(100) DEFAULT NULL,
  prision_preventiva_fundado_plazo VARCHAR(100) DEFAULT NULL,
  prision_preventiva_infundado VARCHAR(100) DEFAULT NULL,
  comparecencia_fundado_plazo VARCHAR(100) DEFAULT NULL,
  comparecencia_infundado VARCHAR(100) DEFAULT NULL,
  sentencia_efectiva VARCHAR(100) DEFAULT NULL,
  sentencia_suspendida VARCHAR(100) DEFAULT NULL,
  estado VARCHAR(30) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE usuarios (
  id INT(11) NOT NULL AUTO_INCREMENT,
  usuario VARCHAR(50) DEFAULT NULL,
  clave VARCHAR(255) DEFAULT NULL,
  rol VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

-- Datos
INSERT INTO carpetas (
  fiscal_responsable,
  fiscalia,
  despacho,
  nro_carpeta,
  fecha,
  delito,
  proceso_inmediato,
  formalizacion,
  prision_preventiva_fundado_plazo,
  prision_preventiva_infundado,
  comparecencia_fundado_plazo,
  comparecencia_infundado,
  sentencia_efectiva,
  sentencia_suspendida,
  estado
) VALUES
('Dra. María Torres', 'Fiscalía Provincial Penal Corporativa de Huancayo', '1er Despacho', '150-2026', '2026-04-17', 'Robo agravado', 'Sí', 'Sí', 'Fundado - 9 meses', 'No', 'No', 'No', 'No', 'No', 'formalizado'),

('Dr. Juan Pérez', 'Fiscalía Provincial Penal Corporativa de Huancayo', '2do Despacho', '151-2026', '2026-04-18', 'Hurto agravado', 'Sí', 'Sí', 'No', 'Infundado', 'Fundado - reglas de conducta', 'No', 'No', 'Sí', 'sentenciado'),

('Dra. Carla Mendoza', 'Fiscalía Provincial Penal Corporativa de Jauja', '1er Despacho', '152-2026', '2026-04-20', 'Lesiones leves', 'No', 'Sí', 'No', 'No', 'Fundado - comparecencia simple', 'No', 'No', 'No', 'formalizado'),

('Dr. Luis Ramos', 'Fiscalía Provincial Penal Corporativa de Concepción', '3er Despacho', '153-2026', '2026-04-21', 'Conducción en estado de ebriedad', 'Sí', 'No', 'No', 'No', 'No', 'Infundado', 'No', 'No', 'archivado'),

('Dra. Ana Salazar', 'Fiscalía Provincial Penal Corporativa de Huancayo', '4to Despacho', '154-2026', '2026-04-22', 'Violencia contra la autoridad', 'Sí', 'Sí', 'Fundado - 6 meses', 'No', 'No', 'No', 'Sí', 'No', 'sentenciado');

-- =========================
-- TABLA: usuarios
-- =========================
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos
INSERT INTO `usuarios` (`usuario`, `clave`, `rol`) VALUES
('admin', '$2y$10$k/sX10Q3fMsGVh6hi594JODfoArD5H3E/C/Mv6BR9vAgTDrgdW6zS', 'admin');
