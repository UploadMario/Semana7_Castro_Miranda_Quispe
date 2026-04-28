<?php
// Utilidad temporal para generar hashes bcrypt.
// Ejemplo: http://localhost/Semana7_Castro_Miranda_Quispe/public/clave.php?clave=admin123
$clave = $_GET['clave'] ?? '123456';
echo password_hash($clave, PASSWORD_BCRYPT);
