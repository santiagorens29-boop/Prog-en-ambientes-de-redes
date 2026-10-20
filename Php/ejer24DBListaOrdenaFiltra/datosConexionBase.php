<?php
// Detección automática del entorno de ejecución
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    // Entorno Local (XAMPP)
    $dbname = "facturacion_db";
    $host = "localhost";
    $user = "root";
    $password = "";
} else {
    // Entorno Remoto (Hosting InfinityFree)
    $dbname = "if0_42985606_facturacion_db";
    $host = "sql210.infinityfree.com";
    $user = "if0_42985606";
    $password = "MiloKala2026"; // La clave copiada del panel
}

// Función para auditoría de errores (phpParteTresBaseDeDatosApunte.pdf Página 14)
function registrarErrorLog($mensaje) {
    $puntero = @fopen(__DIR__ . "/errores.log", "a");
    if ($puntero) {
        $fechaHora = date("Y-m-d H:i:s");
        fwrite($puntero, "[" . $fechaHora . "] " . $mensaje . "\n");
        fclose($puntero);
    }
}
?>