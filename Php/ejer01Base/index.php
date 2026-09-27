<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 01 - Sintaxis Base PHP</title>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>

<div class="contenedor">
    <a href="../index.html" class="boton-volver">&larr; Volver al Menú PHP</a>
    
    <h1>Ejercicio 01: Sintaxis Base, Tipos de Datos y Variables en PHP</h1>

    <!-- 1. Texto nativo sin procesar -->
    <p>Este párrafo está escrito directamente en HTML nativo fuera de las marcas de PHP. Es entregado al navegador sin procesamiento previo del servidor.</p>

    <hr/>

    <!-- 2. Salida generada por PHP -->
    <?php
        echo "<p>Texto y/o etiquetas HTML entregadas dinámicamente por el preprocesador PHP mediante la sentencia <code>echo</code>.</p>";
        echo "<hr/>";

        // Declaración de variables básicas
        $variableA = "DesarrolloWeb2026";
        echo "<p>El valor de <span class='var-nombre'>\$variableA</span> es: " . $variableA . "</p>";
        echo "<p class='var-tipo'>El tipo de \$variableA es: " . gettype($variableA) . "</p>";
        echo "<hr/>";

        $variableB = 15;
        echo "<p>El valor de <span class='var-nombre'>\$variableB</span> es: " . $variableB . "</p>";
        echo "<p class='var-tipo'>El tipo de \$variableB es: " . gettype($variableB) . "</p>";

        $variableC = 25;
        echo "<p>El valor de <span class='var-nombre'>\$variableC</span> es: " . $variableC . "</p>";
        echo "<p class='var-tipo'>El tipo de \$variableC es: " . gettype($variableC) . "</p>";
    ?>

    <div class="caja-info">
        variableD es la suma aritmética de variableB y variableC
    </div>
    <div class="caja-info">
        Si los tipos fueran incompatibles en un contexto estricto, PHP generaría un error de tipado.
    </div>

    <?php
        $variableD = ($variableB + $variableC);
        echo "<p>El valor de <span class='var-nombre'>\$variableD</span> es: " . $variableD . "</p>";
        echo "<p class='var-tipo'>El tipo de \$variableD es: " . gettype($variableD) . "</p>";
        echo "<hr/>";

        // Booleanos
        $variableE = true;
        echo "<p>Variable lógica / booleana verdadera (<span class='var-nombre'>\$variableE</span>): " . $variableE . "</p>";
        echo "<p class='var-tipo'>El tipo de \$variableE es: " . gettype($variableE) . "</p>";

        $variableF = false;
        echo "<p>Variable lógica / booleana falsa (<span class='var-nombre'>\$variableF</span>): " . $variableF . " (el valor false se imprime como cadena vacía)</p>";
        echo "<p class='var-tipo'>El tipo de \$variableF es: " . gettype($variableF) . "</p>";
        echo "<hr/>";

        // Constantes
        define("CONSTANTE_SISTEMA", "ServidorApache_XAMPP");
        echo "<p>Constante <span class='var-nombre'>CONSTANTE_SISTEMA</span>: " . CONSTANTE_SISTEMA . "</p>";
        echo "<p class='var-tipo'>El tipo de CONSTANTE_SISTEMA es: " . gettype(CONSTANTE_SISTEMA) . "</p>";
        echo "<hr/>";
    ?>

    <h2>Arreglos de Índice Numérico</h2>
    <?php
        $aLenguajes = ["PHP", "JavaScript"];
        echo "<p><span class='var-nombre'>\$aLenguajes[0]</span>: " . $aLenguajes[0] . "</p>";
        echo "<p><span class='var-nombre'>\$aLenguajes[1]</span>: " . $aLenguajes[1] . "</p>";
        echo "<p class='var-tipo'>Tipo de \$aLenguajes: " . gettype($aLenguajes) . "</p>";

        // Agregamos elementos dinámicamente con array_push
        array_push($aLenguajes, "Python", "SQL");
        echo "<p><strong>Elementos del array luego de utilizar array_push():</strong></p>";
        echo "<ul>";
        foreach ($aLenguajes as $lenguaje) {
            echo "<li>" . $lenguaje . "</li>";
        }
        echo "</ul>";
        echo "<hr/>";
    ?>

    <h2>Arreglo Bidimensional (Diccionario Multilingüe)</h2>
    <?php
        $diccionarioTerminos = [
            ["computadora", "computer", "ordinateur", "calcolatore"],
            ["pantalla", "screen", "écran", "schermo"],
            ["teclado", "keyboard", "clavier", "tastiera"]
        ];

        echo "<p class='var-tipo'>El tipo de \$diccionarioTerminos es: " . gettype($diccionarioTerminos) . "</p>";
    ?>

    <table>
        <thead>
            <tr>
                <th>Español</th>
                <th>Inglés</th>
                <th>Francés</th>
                <th>Italiano</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($diccionarioTerminos as $fila) {
                    echo "<tr>";
                    echo "<td>" . $fila[0] . "</td>";
                    echo "<td>" . $fila[1] . "</td>";
                    echo "<td>" . $fila[2] . "</td>";
                    echo "<td>" . $fila[3] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <?php
        echo "<p>Acceso directo a una posición específica: <span class='var-nombre'>\$diccionarioTerminos[1][2]</span> = <strong>" . $diccionarioTerminos[1][2] . "</strong></p>";
        echo "<p>Cantidad total de filas registradas en el diccionario: <strong>" . count($diccionarioTerminos) . "</strong></p>";
        echo "<hr/>";
    ?>

    <h2>Variables de Tipo Arreglo Asociativo</h2>
    <div class="caja-info">
        Carga de datos de un producto en un vector asociativo clave => valor y lectura de atributos.
    </div>

    <?php
        $producto = [
            "codigo" => "HW-1092",
            "descripcion" => "Procesador AMD Ryzen 7",
            "precioUnitario" => 285000,
            "stock" => 12
        ];

        echo "<p><strong>Código de producto:</strong> " . $producto["codigo"] . " <span class='var-tipo'>(tipo: " . gettype($producto["codigo"]) . ")</span></p>";
        echo "<p><strong>Descripción:</strong> " . $producto["descripcion"] . " <span class='var-tipo'>(tipo: " . gettype($producto["descripcion"]) . ")</span></p>";
        echo "<p><strong>Precio unitario:</strong> $" . $producto["precioUnitario"] . " <span class='var-tipo'>(tipo: " . gettype($producto["precioUnitario"]) . ")</span></p>";
        echo "<p><strong>Stock disponible:</strong> " . $producto["stock"] . " <span class='var-tipo'>(tipo: " . gettype($producto["stock"]) . ")</span></p>";
        echo "<p>Cantidad total de claves en el arreglo asociativo: <strong>" . count($producto) . "</strong></p>";
        echo "<p class='var-tipo'>Tipo de dato de la variable \$producto: " . gettype($producto) . "</p>";
        echo "<hr/>";
    ?>

    <h2>Expresiones Aritméticas</h2>
    <?php
        $valX = 8;
        $valY = 5;

        echo "<p>Variable <span class='var-nombre'>\$valX</span> = " . $valX . " <span class='var-tipo'>(tipo: " . gettype($valX) . ")</span></p>";
        echo "<p>Variable <span class='var-nombre'>\$valY</span> = " . $valY . " <span class='var-tipo'>(tipo: " . gettype($valY) . ")</span></p>";
        echo "<p>Resultado de Suma (\$valX + \$valY): <strong>" . ($valX + $valY) . "</strong></p>";
        echo "<p>Resultado de Multiplicación (\$valX * \$valY): <strong>" . ($valX * $valY) . "</strong></p>";
        echo "<p>Resultado de División (\$valX / \$valY): <strong>" . ($valX / $valY) . "</strong></p>";
        echo "<hr/>";
    ?>

    <h2>Alcance de Variables: Ámbito Global ($GLOBALS)</h2>
    <p>Las variables declaradas fuera de las funciones se registran en la matriz superglobal <code>$GLOBALS</code>.</p>
    <?php
        $nro1 = 60;
        $nro2 = 35;

        echo "<p>El valor de <span class='var-nombre'>\$nro1</span> es: " . $nro1 . "</p>";
        echo "<p>El valor de <span class='var-nombre'>\$nro2</span> es: " . $nro2 . "</p>";
        
        $sumaGlobales = $GLOBALS['nro1'] + $GLOBALS['nro2'];
        echo "<p>Suma obtenida accediendo a \$GLOBALS: <strong>\$GLOBALS['nro1'] + \$GLOBALS['nro2'] = " . $sumaGlobales . "</strong></p>";
    ?>

</div>

</body>
</html>