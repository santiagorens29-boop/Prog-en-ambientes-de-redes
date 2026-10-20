<?php
header('Content-Type: application/json; charset=utf-8');
include(__DIR__ . "/datosConexionBase.php");

// Retardo simulado para observar estados de la promesa en el cliente (Página 9)
sleep(1);

// Recepción de orden y filtros pasados en el body mediante POST
$orden = isset($_POST['orden']) && $_POST['orden'] !== '' ? $_POST['orden'] : 'nro_factura';

// Sanitización de columnas válidas para evitar SQL Injection en la cláusula ORDER BY
$columnasValidas = ['nro_factura', 'cod_prod', 'descripcion', 'unidad_medida', 'cantidad', 'precio_unit', 'total_renglon', 'fecha_factura'];
if (!in_array($orden, $columnasValidas)) {
    $orden = 'nro_factura';
}

$f_nro_factura = isset($_POST['f_nro_factura']) ? trim($_POST['f_nro_factura']) : '';
$f_cod_prod = isset($_POST['f_cod_prod']) ? trim($_POST['f_cod_prod']) : '';
$f_descripcion = isset($_POST['f_descripcion']) ? trim($_POST['f_descripcion']) : '';
$f_unidad_medida = isset($_POST['f_unidad_medida']) ? trim($_POST['f_unidad_medida']) : '';
$f_fecha_factura = isset($_POST['f_fecha_factura']) ? trim($_POST['f_fecha_factura']) : '';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta con sentencias preparadas y operador LIKE (Páginas 11 y 12 del apunte)
    $sql = "SELECT nro_factura, cod_prod, descripcion, unidad_medida, cantidad, precio_unit, total_renglon, fecha_factura 
            FROM renglones_factura 
            WHERE nro_factura LIKE CONCAT('%', :nro_factura, '%')
              AND cod_prod LIKE CONCAT('%', :cod_prod, '%')
              AND descripcion LIKE CONCAT('%', :descripcion, '%')
              AND unidad_medida LIKE CONCAT('%', :unidad_medida, '%')
              AND fecha_factura LIKE CONCAT('%', :fecha_factura, '%')
            ORDER BY $orden ASC";

    $stmt = $dbh->prepare($sql);

    // Vinculación de parámetros
    $stmt->bindParam(':nro_factura', $f_nro_factura);
    $stmt->bindParam(':cod_prod', $f_cod_prod);
    $stmt->bindParam(':descripcion', $f_descripcion);
    $stmt->bindParam(':unidad_medida', $f_unidad_medida);
    $stmt->bindParam(':fecha_factura', $f_fecha_factura);

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
        $objRenglon->fecha_factura = $fila['fecha_factura'];
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