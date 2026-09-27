<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 02 - Inclusión de Archivos (include)</title>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>

<div class="contenedor">
    <a href="../index.html" class="boton-volver">&larr; Volver al Menú PHP</a>

    <h1>Ejercicio 02: Modularización mediante include()</h1>

    <div class="bloque-aviso">
        <p><strong>Comportamiento de la función <code>include()</code>:</strong></p>
        <p>En este ejercicio se ubica código PHP definido en el archivo externo <code>asignaciones.php</code>.</p>
        <p>Antes de insertar el <code>include()</code> las variables declaradas en el mismo no existen en memoria.</p>
        <p>A pesar de producirse advertencias (warnings), el ciclo de ejecución de PHP continúa hasta el final del script.</p>
    </div>

    <h2>Lectura de variables previas a la inclusión:</h2>
    
    <div class="caja-warning">
        <?php
            // Se intenta acceder a las variables ANTES del include para forzar las advertencias
            echo $personaA['nombre'];
            echo $personaA['apellido'];
            echo $personaA['nacimiento'];
            
            echo $personaB['nombre'];
            echo $personaB['apellido'];
            echo $personaB['nacimiento'];
        ?>
    </div>

    <div class="bloque-aviso">
        <p><strong>Punto de ejecución de la inclusión:</strong></p>
        <p>En este punto se ejecuta la sentencia <code>include("./asignaciones.php");</code>. Si el archivo no existiera, PHP emitiría un Warning y seguiría ejecutando.</p>
    </div>

    <?php
        // Inclusión del archivo externo
        include("./asignaciones.php");
    ?>

    <h2>Datos obtenidos desde el archivo externo:</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Año Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $personaA['nombre']; ?></td>
                <td><?php echo $personaA['apellido']; ?></td>
                <td><?php echo $personaA['nacimiento']; ?></td>
            </tr>
            <tr>
                <td><?php echo $personaB['nombre']; ?></td>
                <td><?php echo $personaB['apellido']; ?></td>
                <td><?php echo $personaB['nacimiento']; ?></td>
            </tr>
        </tbody>
    </table>

    <?php
        echo "<p>La longitud del arreglo asociativo \$personaA es: <strong>" . count($personaA) . "</strong> elementos.</p>";
        echo "<p>La longitud del arreglo asociativo \$personaB es: <strong>" . count($personaB) . "</strong> elementos.</p>";
    ?>

</div>

</body>
</html>