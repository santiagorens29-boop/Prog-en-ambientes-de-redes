<?php
// Simulación de proceso pesado en el servidor (4 segundos de retardo)
// Referencia: Página 9 de phpParte2.pdf
sleep(4);

// Verificamos y capturamos los parámetros del requerimiento POST
$metodoRequerimiento = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'POST';
$claveRecibida = isset($_POST['clave']) ? $_POST['clave'] : '';

// Generación de algoritmos de encriptación unidireccional (Página 2 del PDF)
$hashMd5 = md5($claveRecibida);
$hashSha1 = sha1($claveRecibida);
?>

<div class="res-item">
    <p><strong>Request_method:</strong> <?php echo htmlspecialchars($metodoRequerimiento); ?></p>
    <p><strong>Clave procesada:</strong> <?php echo htmlspecialchars($claveRecibida); ?></p>
</div>

<div class="res-item">
    <p><strong>Clave encriptada en md5 (128 bits o 16 pares hexadecimales):</strong></p>
    <span class="res-hash"><?php echo $hashMd5; ?></span>
</div>

<div class="res-item">
    <p><strong>Clave encriptada en sha1 (160 bits o 20 pares hexadecimales):</strong></p>
    <span class="res-hash"><?php echo $hashSha1; ?></span>
</div>