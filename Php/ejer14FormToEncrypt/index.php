<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14 - Encriptación Unidireccional (Hashing)</title>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>

<div class="tarjeta">
    <?php
    // Si se enviaron datos por POST, procesamos y mostramos los hashes
    if (isset($_POST['clave'])) {
        $claveOriginal = $_POST['clave'];
        
        // Hashing MD5 (128 bits = 16 octetos = 32 caracteres hexadecimales)
        $hashMd5 = md5($claveOriginal);
        
        // Hashing SHA-256 (256 bits = 32 octetos = 64 caracteres hexadecimales)
        $hashSha256 = hash('sha256', $claveOriginal);
    ?>
        <h1>Resultado de la Encriptación Unidireccional</h1>

        <div class="resultado-hash">
            <div class="bloque-hash">
                <p><strong>Clave:</strong> <?php echo htmlspecialchars($claveOriginal); ?></p>
                <p class="titulo-algoritmo">Clave encriptada en md5 (128 bits o 16 octetos o 16 pares hexadecimales):</p>
                <span class="valor-hash"><?php echo $hashMd5; ?></span>
            </div>

            <hr style="border: none; border-top: 1px dashed #cbd5e1; margin: 14px 0;">

            <div class="bloque-hash">
                <p><strong>Clave:</strong> <?php echo htmlspecialchars($claveOriginal); ?></p>
                <p class="titulo-algoritmo">Clave encriptada en sha256 (256 bits o 32 octetos o 32 pares hexadecimales):</p>
                <span class="valor-hash"><?php echo $hashSha256; ?></span>
            </div>
        </div>

        <a href="./index.php" class="btn-volver">&larr; Volver a Encriptar</a>

    <?php
    } else {
        // En caso contrario, mostramos el formulario de entrada
    ?>
        <h1>Encriptación Unidireccional en PHP</h1>
        
        <form action="./index.php" method="post">
            <div class="grupo-campo">
                <label for="clave">Ingrese la clave a encriptar:</label>
                <input type="text" id="clave" name="clave" required autofocus>
            </div>
            
            <button type="submit" class="btn-accion">Obtener encriptación</button>
        </form>
    <?php
    }
    ?>
</div>

</body>
</html>