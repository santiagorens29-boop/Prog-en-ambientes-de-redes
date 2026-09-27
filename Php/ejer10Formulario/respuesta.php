<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10 - Respuesta del Servidor</title>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>

<div class="tarjeta">
    <h1>Valores pasados por GET</h1>

    <div class="resultado-datos">
        <?php
            // Captura de datos recibidos a través de la superglobal $_GET
            $nombre = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '';
            $apellido = isset($_GET['apellido']) ? htmlspecialchars($_GET['apellido']) : '';

            echo "<p><strong>Nombre = </strong>" . $nombre . "</p>";
            echo "<p><strong>Apellido = </strong>" . $apellido . "</p>";
        ?>
    </div>

    <!-- Botón para volver al formulario original -->
    <a href="./index.html" class="btn-volver">Volver</a>
</div>

</body>
</html>