<?php
header('Content-Type: application/json; charset=utf-8');
include(__DIR__ . "/datosConexionBase.php");

// Retardo didáctico (Página 9 del apunte)
sleep(1);

// Recepción de orden y filtros
$orden = isset($_POST['orden']) && $_POST['orden'] !== '' ? $_POST['orden'] : 'nro_factura';

// Columnas válidas para ORDER BY
$columnasValidas = ['nro_factura', 'cod_prod', 'descripcion', 'unidad_medida', 'cantidad', 'precio_unit', 'total_renglon', 'pdf_comprobante'];
if (!in_array($orden, $columnasValidas)) {
    $orden = 'nro_factura';
}

$f_nro_factura = isset($_POST['f_nro_factura']) ? trim($_POST['f_nro_factura']) : '';
$f_cod_prod = isset($_POST['f_cod_prod']) ? trim($_POST['f_cod_prod']) : '';
$f_descripcion = isset($_POST['f_descripcion']) ? trim($_POST['f_descripcion']) : '';
$f_unidad_medida = isset($_POST['f_unidad_medida']) ? trim($_POST['f_unidad_medida']) : '';
$f_pdf_comprobante = isset($_POST['f_pdf_comprobante']) ? trim($_POST['f_pdf_comprobante']) : '';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT nro_factura, cod_prod, descripcion, unidad_medida, cantidad, precio_unit, total_renglon, pdf_comprobante 
            FROM renglones_factura 
            WHERE nro_factura LIKE CONCAT('%', :nro_factura, '%')
              AND cod_prod LIKE CONCAT('%', :cod_prod, '%')
              AND descripcion LIKE CONCAT('%', :descripcion, '%')
              AND unidad_medida LIKE CONCAT('%', :unidad_medida, '%')
              AND (pdf_comprobante LIKE CONCAT('%', :pdf_comprobante, '%') OR :pdf_comprobante = '')
            ORDER BY $orden ASC";

    $stmt = $dbh->prepare($sql);

    $stmt->bindParam(':nro_factura', $f_nro_factura);
    $stmt->bindParam(':cod_prod', $f_cod_prod);
    $stmt->bindParam(':descripcion', $f_descripcion);
    $stmt->bindParam(':unidad_medida', $f_unidad_medida);
    $stmt->bindParam(':pdf_comprobante', $f_pdf_comprobante);

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $renglones = [];
    while ($fila = $stmt->fetch()) {
        $objRenglon = new stdClass();
        $objRenglon->nro_factura = $fila['nro_factura'];
        $objRenglon->cod_prod = $fila['cod_prod'];
        $objRenglon->descripcion = $fila['descripcion'];
        $objRenglon->unidad_medida = $fila['unidad_medida'];
        $objRenglon->cantidad = (float)$fila['cantidad'];
        $objRenglon->precio_unit = (float)$fila['precio_unit'];
        $objRenglon->total_renglon = (float)$fila['total_renglon'];
        // Si el campo es nulo o viene vacío, asignamos el nombre de comprobante estándar
        $objRenglon->pdf_comprobante = !empty($fila['pdf_comprobante']) ? $fila['pdf_comprobante'] : "factura_" . strtolower(str_replace(['-', ' '], '_', $fila['nro_factura'])) . ".pdf";
        array_push($renglones, $objRenglon);
    }

    $objSalida = new stdClass();
    $objSalida->renglones = $renglones;
    $objSalida->cuenta = count($renglones);

    echo json_encode($objSalida);
    $dbh = null;

} catch (PDOException $e) {
    registrarErrorLog("Error en salidaJsonFacturasConPrepare: " . $e->getMessage());
    $objError = new stdClass();
    $objError->error = true;
    $objError->mensaje = "Error al consultar facturas: " . $e->getMessage();
    echo json_encode($objError);
}
?>