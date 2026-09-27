<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 04 - Variables de Tipo Objeto y JSON en PHP</title>
    <link rel="stylesheet" href="./estilo.css">
</head>
<body>

<div class="contenedor">
    <a href="../index.html" class="boton-volver">&larr; Volver al Menú PHP</a>

    <h1>Variables tipo objeto en PHP. Objeto renglón de pedido</h1>

    <?php
        // 1. Declaración e instanciación de un objeto básico con stdClass
        $objRenglonPedido = new stdClass();
        $objRenglonPedido->codArt = "HW-001";
        $objRenglonPedido->descripcion = "Disco Solido SSD NVMe 1TB";
        $objRenglonPedido->precioUnitario = 95000;
        $objRenglonPedido->cantidad = 2;
    ?>

    <p class="var-titulo">\$objRenglonPedido</p>
    <div class="caja-detalle">
        <p>Código de artículo: <?php echo $objRenglonPedido->codArt; ?></p>
        <p>Descripción del artículo: <?php echo $objRenglonPedido->descripcion; ?></p>
        <p>Precio unitario: $<?php echo $objRenglonPedido->precioUnitario; ?></p>
        <p>Cantidad: <?php echo $objRenglonPedido->cantidad; ?></p>
    </div>
    <p class="caja-tipo">Tipo de <strong>\$objRenglonPedido</strong>: <?php echo gettype($objRenglonPedido); ?></p>

    <hr/>

    <h2>Definamos arreglo de pedidos:</h2>
    <?php
        // 2. Vector numérico para alojar múltiples objetos
        $renglonesPedido = [];
        array_push($renglonesPedido, $objRenglonPedido);

        // Creamos un segundo objeto para sumar al arreglo
        $objRenglonPedido2 = new stdClass();
        $objRenglonPedido2->codArt = "HW-002";
        $objRenglonPedido2->descripcion = "Memoria RAM DDR5 16GB";
        $objRenglonPedido2->precioUnitario = 68000;
        $objRenglonPedido2->cantidad = 4;
        array_push($renglonesPedido, $objRenglonPedido2);
    ?>

    <p class="var-titulo">\$renglonesPedido</p>
    <p class="caja-tipo">Tipo de <strong>\$renglonesPedido</strong>: <?php echo gettype($renglonesPedido); ?></p>

    <h2>Tabula \$renglonesPedido. Recorrer el arreglo de renglones y tabularlos con HTML:</h2>
    <table>
        <thead>
            <tr>
                <th>Código Art.</th>
                <th>Descripción</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($renglonesPedido as $renglon) {
                    echo "<tr>";
                    echo "<td>" . $renglon->codArt . "</td>";
                    echo "<td>" . $renglon->descripcion . "</td>";
                    echo "<td>$" . $renglon->precioUnitario . "</td>";
                    echo "<td>" . $renglon->cantidad . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <p>Cantidad de renglones: <strong><?php echo count($renglonesPedido); ?></strong></p>

    <hr/>

    <h2>Producción de un objeto \$objRenglonesPedido con dos atributos: array renglonesPedido y cantidadDeRenglones</h2>
    <?php
        // 3. Empaquetado en un objeto contenedor compuesto
        $objRenglonesPedido = new stdClass();
        $objRenglonesPedido->renglonesPedido = $renglonesPedido;
        $objRenglonesPedido->cantidadDeRenglones = count($renglonesPedido);
    ?>
    <p>Cantidad de renglones leída desde el atributo del objeto contenedor: <strong><?php echo $objRenglonesPedido->cantidadDeRenglones; ?></strong></p>

    <hr/>

    <h2>Producción de un JSON jsonRenglones:</h2>
    <?php
        // 4. Serialización a JSON listo para ser consumido por el navegador / JavaScript
        $jsonRenglones = json_encode($objRenglonesPedido);
    ?>
    <div class="caja-json">
<?php echo $jsonRenglones; ?>
    </div>

</div>

</body>
</html>