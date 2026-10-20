<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 24 - Base de Datos: Lista, Ordena y Filtra (MVT - SPA)</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0f172a;
            color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 15px 25px;
        }

        .barra-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .btn-volver {
            background-color: #334155;
            color: #ffffff;
            text-decoration: none;
            padding: 7px 15px;
            border-radius: 5px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .btn-volver:hover {
            background-color: #475569;
        }

        .tablero-spa {
            background-color: #1e293b;
            border-radius: 8px;
            border: 1px solid #334155;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            flex: 1;
        }

        .tablero-header {
            background-color: #f8fafc;
            color: #0f172a;
            padding: 14px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            border-bottom: 2px solid #cbd5e1;
        }

        .tablero-titulo h1 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }

        .tablero-titulo span {
            font-size: 0.82rem;
            color: #64748b;
        }

        .tablero-controles {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grupo-orden {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .grupo-orden label {
            font-weight: bold;
            font-size: 0.85rem;
            color: #334155;
        }

        .grupo-orden input {
            padding: 6px 10px;
            font-size: 0.85rem;
            border: 1px solid #94a3b8;
            border-radius: 4px;
            background-color: #ffffff;
            color: #0f172a;
            font-weight: bold;
            width: 140px;
        }

        .btn-control {
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-cargar {
            background-color: #2563eb;
            color: #ffffff;
        }

        .btn-vaciar {
            background-color: #64748b;
            color: #ffffff;
        }

        .btn-control:hover {
            opacity: 0.9;
        }

        .contenedor-tabla {
            width: 100%;
            overflow-x: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
            max-height: calc(100vh - 240px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .fila-titulos th {
            background-color: #ef4444;
            color: #ffffff;
            padding: 10px 8px;
            font-size: 0.85rem;
            text-align: left;
            cursor: pointer;
            user-select: none;
            border-right: 1px solid #dc2626;
            transition: background-color 0.15s;
        }

        .fila-titulos th:hover {
            background-color: #dc2626;
            text-decoration: underline;
        }

        .fila-filtros th {
            background-color: #fee2e2;
            padding: 6px 8px;
            border-bottom: 2px solid #ef4444;
            border-right: 1px solid #fca5a5;
        }

        .fila-filtros input, .fila-filtros select {
            width: 100%;
            padding: 5px 6px;
            font-size: 0.8rem;
            border: 1px solid #cbd5e1;
            border-radius: 3px;
            background-color: #ffffff;
            color: #0f172a;
            outline: none;
        }

        tbody {
            background-color: #334155;
            color: #f8fafc;
        }

        tbody tr {
            border-bottom: 1px solid #475569;
            transition: background-color 0.15s;
        }

        tbody tr:nth-child(even) {
            background-color: #3b4b61;
        }

        tbody tr:hover {
            background-color: #1e293b;
        }

        tbody td {
            padding: 9px 8px;
            font-size: 0.85rem;
            border-right: 1px solid #475569;
        }

        .btn-pdf {
            display: inline-block;
            background-color: #ef4444;
            color: #ffffff;
            padding: 3px 8px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .estado-espera {
            text-align: center;
            font-style: italic;
            padding: 30px !important;
            color: #fde047;
            font-size: 0.95rem;
        }

        .tablero-footer {
            background-color: #f8fafc;
            color: #0f172a;
            padding: 8px 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #cbd5e1;
        }
    </style>
</head>
<body>

    <div class="barra-nav">
        <a href="../index.html" class="btn-volver">&larr; Volver al Menú PHP</a>
        <span style="font-size: 0.85rem; color: #94a3b8;">Tecnología: PHP + PDO + MySQL + Fetch API (MVT)</span>
    </div>

    <div class="tablero-spa">
        <div class="tablero-header">
            <div class="tablero-titulo">
                <h1>Renglones de Factura de Compra</h1>
                <span>Familia 13 | Alumno: Rens Santiago</span>
            </div>

            <div class="tablero-controles">
                <div class="grupo-orden">
                    <label for="orden">Orden:</label>
                    <input type="text" id="orden" value="nro_factura" readonly>
                </div>
                <button type="button" id="btnCargar" class="btn-control btn-cargar">Cargar datos</button>
                <button type="button" id="btnVaciar" class="btn-control btn-vaciar">Vaciar datos</button>
            </div>
        </div>

        <div class="contenedor-tabla">
            <table>
                <thead>
                    <tr class="fila-titulos">
                        <th data-col="nro_factura" title="Ordenar por NroFactura">Nro Factura &uarr;&darr;</th>
                        <th data-col="cod_prod" title="Ordenar por Código Producto">Cód Prod &uarr;&darr;</th>
                        <th data-col="descripcion" title="Ordenar por Descripción">Descripción Producto/Servicio &uarr;&darr;</th>
                        <th data-col="unidad_medida" title="Ordenar por Unidad">Unidad Medida &uarr;&darr;</th>
                        <th data-col="cantidad" title="Ordenar por Cantidad">Cantidad &uarr;&darr;</th>
                        <th data-col="precio_unit" title="Ordenar por Precio">Precio Unit &uarr;&darr;</th>
                        <th data-col="total_renglon" title="Ordenar por Total">Total Renglón &uarr;&darr;</th>
                        <th data-col="pdf_comprobante" title="Ordenar por Comprobante">PdfComprobante &uarr;&darr;</th>
                    </tr>

                    <tr class="fila-filtros">
                        <th><input type="text" id="f_nro_factura" placeholder="Filtrar nro..."></th>
                        <th><input type="text" id="f_cod_prod" placeholder="Filtrar cód..."></th>
                        <th><input type="text" id="f_descripcion" placeholder="Filtrar descrip..."></th>
                        <th>
                            <select id="f_unidad_medida">
                                <option value="">Todas</option>
                            </select>
                        </th>
                        <th><input type="text" id="f_cantidad" disabled placeholder="-"></th>
                        <th><input type="text" id="f_precio_unit" disabled placeholder="-"></th>
                        <th><input type="text" id="f_total_renglon" disabled placeholder="-"></th>
                        <th><input type="text" id="f_pdf_comprobante" placeholder="Filtrar pdf..."></th>
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">
                    <tr>
                        <td colspan="8" class="estado-espera" style="color: #cbd5e1;">Presione el botón "Cargar datos" para consultar el servidor.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="tablero-footer">
            <div id="lblRegistros">Nro de registros: 0</div>
            <div>Pie de Tablero SPA</div>
        </div>
    </div>

    <script>
        const inputOrden = document.getElementById('orden');
        const btnCargar = document.getElementById('btnCargar');
        const btnVaciar = document.getElementById('btnVaciar');
        const cuerpoTabla = document.getElementById('cuerpoTabla');
        const lblRegistros = document.getElementById('lblRegistros');
        const selectUnidad = document.getElementById('f_unidad_medida');

        // Inputs de filtros
        const fNroFactura = document.getElementById('f_nro_factura');
        const fCodProd = document.getElementById('f_cod_prod');
        const fDescripcion = document.getElementById('f_descripcion');
        const fPdfComprobante = document.getElementById('f_pdf_comprobante');

        // 1. Cargar combo auxiliar de unidades de medida al inicio
        document.addEventListener('DOMContentLoaded', function () {
            fetch('./salidaJsonUnidadesMedida.php')
                .then(res => res.json())
                .then(data => {
                    alert("Alerta al abrir el ejercicio (Tabla Auxiliar de Unidades de Medida en JSON):\n\n" + JSON.stringify(data));

                    if (data.unidadesMedida) {
                        data.unidadesMedida.forEach(item => {
                            const opt = document.createElement('option');
                            opt.value = item.id_uni;
                            opt.textContent = item.descripcion;
                            selectUnidad.appendChild(opt);
                        });
                    }
                })
                .catch(err => console.error("Error al cargar unidades:", err));
        });

        // 2. Función cargaTabla()
        function cargaTabla() {
            const objDatosOrdenFiltros = new URLSearchParams();
            objDatosOrdenFiltros.append('orden', inputOrden.value);
            objDatosOrdenFiltros.append('f_nro_factura', fNroFactura.value);
            objDatosOrdenFiltros.append('f_cod_prod', fCodProd.value);
            objDatosOrdenFiltros.append('f_descripcion', fDescripcion.value);
            objDatosOrdenFiltros.append('f_unidad_medida', selectUnidad.value);
            objDatosOrdenFiltros.append('f_pdf_comprobante', fPdfComprobante.value);

            // Alert 1: Parámetros en el body POST
            alert("Lo que sale del navegador en el body (POST):\n" + objDatosOrdenFiltros.toString());

            cuerpoTabla.innerHTML = '<tr><td colspan="8" class="estado-espera">Esperando respuesta del servidor...</td></tr>';
            lblRegistros.textContent = 'Nro de registros: ...';

            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: objDatosOrdenFiltros
            };

            fetch('./salidaJsonFacturasConPrepare.php', options)
                .then(res => res.text())
                .then(textoJson => {
                    // Alert 2: Promesa Cumplida con JSON en crudo
                    alert("Respuesta arribada del servidor (Promesa Cumplida):\n\n" + textoJson);

                    const data = JSON.parse(textoJson);
                    cuerpoTabla.innerHTML = '';

                    if (data.error) {
                        cuerpoTabla.innerHTML = `<tr><td colspan="8" class="estado-espera" style="color:#f87171;">${data.mensaje}</td></tr>`;
                        lblRegistros.textContent = 'Nro de registros: 0';
                        return;
                    }

                    if (!data.renglones || data.renglones.length === 0) {
                        cuerpoTabla.innerHTML = '<tr><td colspan="8" class="estado-espera">No se encontraron registros con los filtros indicados.</td></tr>';
                        lblRegistros.textContent = 'Nro de registros: 0';
                        return;
                    }

                    data.renglones.forEach(r => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${r.nro_factura}</td>
                            <td>${r.cod_prod}</td>
                            <td>${r.descripcion}</td>
                            <td>${r.unidad_medida}</td>
                            <td>${r.cantidad}</td>
                            <td>$${r.precio_unit.toFixed(2)}</td>
                            <td>$${r.total_renglon.toFixed(2)}</td>
                            <td>
                                <span class="btn-pdf" title="Comprobante digital">&#128196; ${r.pdf_comprobante}</span>
                            </td>
                        `;
                        cuerpoTabla.appendChild(tr);
                    });

                    lblRegistros.textContent = 'Nro de registros: ' + (data.cuenta !== undefined ? data.cuenta : data.renglones.length);
                })
                .catch(err => {
                    alert("Error en la conexión de red: " + err);
                    cuerpoTabla.innerHTML = '<tr><td colspan="8" class="estado-espera" style="color:#f87171;">Fallo al conectar con el servidor.</td></tr>';
                    lblRegistros.textContent = 'Nro de registros: 0';
                });
        }

        // Manejadores de eventos
        btnCargar.addEventListener('click', cargaTabla);

        btnVaciar.addEventListener('click', function () {
            cuerpoTabla.innerHTML = '<tr><td colspan="8" class="estado-espera" style="color: #cbd5e1;">Presione el botón "Cargar datos" para consultar el servidor.</td></tr>';
            lblRegistros.textContent = 'Nro de registros: 0';
        });

        document.querySelectorAll('.fila-titulos th').forEach(th => {
            th.addEventListener('click', function () {
                const columna = this.getAttribute('data-col');
                inputOrden.value = columna;
                cargaTabla();
            });
        });

        selectUnidad.addEventListener('change', cargaTabla);

        [fNroFactura, fCodProd, fDescripcion, fPdfComprobante].forEach(inp => {
            inp.addEventListener('keyup', function (e) {
                if (e.key === 'Enter') {
                    cargaTabla();
                }
            });
        });
    </script>
</body>
</html>