<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 03 - Variables de Servidor ($_SERVER)</title>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>

<div class="contenedor">
    <a href="../index.html" class="boton-volver">&larr; Volver al Menú PHP</a>
    
    <h1>Variables del Entorno de Servidor y Requerimiento HTTP</h1>

    <!-- 1. Variables de Servidor -->
    <h2>Variables de Servidor</h2>
    <table>
        <tbody>
            <tr>
                <th>SERVER_ADDR</th>
                <td><?php echo isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : 'No asignado en entorno local'; ?></td>
            </tr>
            <tr>
                <th>SERVER_PORT</th>
                <td><?php echo $_SERVER['SERVER_PORT']; ?></td>
            </tr>
            <tr>
                <th>SERVER_NAME</th>
                <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
            </tr>
            <tr>
                <th>HTTP_HOST</th>
                <td><?php echo $_SERVER['HTTP_HOST']; ?></td>
            </tr>
            <tr>
                <th>DOCUMENT_ROOT</th>
                <td><?php echo $_SERVER['DOCUMENT_ROOT']; ?></td>
            </tr>
        </tbody>
    </table>

    <!-- 2. Variables de Cliente -->
    <h2>Variables de Cliente</h2>
    <table>
        <tbody>
            <tr>
                <th>REMOTE_ADDR</th>
                <td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
            </tr>
            <tr>
                <th>REMOTE_PORT</th>
                <td><?php echo $_SERVER['REMOTE_PORT']; ?></td>
            </tr>
        </tbody>
    </table>

    <!-- 3. Variables de Requerimiento -->
    <h2>Variables de Requerimiento</h2>
    <table>
        <tbody>
            <tr>
                <th>SCRIPT_NAME</th>
                <td><?php echo $_SERVER['SCRIPT_NAME']; ?></td>
            </tr>
            <tr>
                <th>REQUEST_METHOD</th>
                <td><?php echo $_SERVER['REQUEST_METHOD']; ?></td>
            </tr>
            <tr>
                <th>REQUEST_URI</th>
                <td><?php echo $_SERVER['REQUEST_URI']; ?></td>
            </tr>
            <tr>
                <th>QUERY_STRING</th>
                <td><?php echo isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] !== '' ? $_SERVER['QUERY_STRING'] : '(vacío)'; ?></td>
            </tr>
        </tbody>
    </table>

    <!-- 4. Recorrido completo con foreach -->
    <h2>TODAS LAS VARIABLES DEL ARREGLO GLOBAL $_SERVER</h2>
    <div class="caja-todas">
<?php
    foreach ($_SERVER as $clave => $valor) {
        // En caso de que algún valor sea un array anidado se gestiona con print_r
        if (is_array($valor)) {
            echo "<span class='variable-clave'>" . $clave . "</span>: " . implode(", ", $valor) . "\n";
        } else {
            echo "<span class='variable-clave'>" . $clave . "</span>: " . $valor . "\n";
        }
    }
?>
    </div>

</div>

</body>
</html>