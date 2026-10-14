<?php
// Simulación pedagógica de retardo de respuesta (3 segundos)
// Referencia: Página 9 de phpParte2.pdf
sleep(3);

// Instanciación de objeto genérico stdClass (Página 10 de phpParte2.pdf)
$objFactura = new stdClass();

// Asignación de propiedades obtenidas del array superglobal $_POST
$objFactura->NroFactura = isset($_POST['nroFactura']) ? $_POST['nroFactura'] : '';
$objFactura->codProd = isset($_POST['codProd']) ? $_POST['codProd'] : '';
$objFactura->Descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$objFactura->UnidadMedida = isset($_POST['unidadMedida']) ? $_POST['unidadMedida'] : '';
$objFactura->Cantidad = isset($_POST['cantidad']) ? (float)$_POST['cantidad'] : 0;
$objFactura->PrecioUnit = isset($_POST['precioUnit']) ? (float)$_POST['precioUnit'] : 0;
$objFactura->TotalRenglon = isset($_POST['totalRenglon']) ? (float)$_POST['totalRenglon'] : 0;
$objFactura->PdfComprobante = isset($_POST['pdfComprobante']) ? $_POST['pdfComprobante'] : '';

// Metadatos adicionales para demostrar procesamiento
$objFactura->Alumno = "Rens Santiago";
$objFactura->Tema = "13) Renglones de factura de compra";

// Producción de la cadena JSON (Página 10 de phpParte2.pdf)
$jsonFactura = json_encode($objFactura);

// Entrega del resultado
echo $jsonFactura;
?>