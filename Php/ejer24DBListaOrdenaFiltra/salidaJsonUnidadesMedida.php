<?php
header('Content-Type: application/json; charset=utf-8');
include(__DIR__ . "/datosConexionBase.php");

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id_uni, descripcion FROM unidades_medida ORDER BY descripcion ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $unidades = [];
    while ($fila = $stmt->fetch()) {
        $objUni = new stdClass();
        $objUni->id_uni = $fila['id_uni'];
        $objUni->descripcion = $fila['descripcion'];
        array_push($unidades, $objUni);
    }

    $objSalida = new stdClass();
    $objSalida->unidadesMedida = $unidades;
    $objSalida->cuenta = count($unidades);

    echo json_encode($objSalida);
    $dbh = null;

} catch (PDOException $e) {
    registrarErrorLog("Error en salidaJsonUnidadesMedida: " . $e->getMessage());
    $objError = new stdClass();
    $objError->error = true;
    $objError->mensaje = "Error al consultar unidades de medida: " . $e->getMessage();
    echo json_encode($objError);
}
?>