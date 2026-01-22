<?php
// Esto generará un hash válido matemáticamente para "admin123"
$hash = password_hash("admin123", PASSWORD_DEFAULT);
echo "Copia este hash en tu base de datos: <br>";
echo $hash;
?>