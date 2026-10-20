<?php
// Credenciales para entorno local XAMPP
$dbname = "facturacion_db";
$host = "localhost";
$user = "root";
$password = "";

// Función modular para auditoría de errores (phpParteTresBaseDeDatosApunte.pdf Página 14)
function registrarErrorLog($mensaje) {
    $puntero = @fopen(__DIR__ . "/errores.log", "a");
    if ($puntero) {
        $fechaHora = date("Y-m-d H:i:s");
        fwrite($puntero, "[" . $fechaHora . "] " . $mensaje . "\n");
        fclose($puntero);
    }
}
?>