// Captura de referencias del DOM
const inputDato = document.getElementById('entradaClave');
const btnDisparo = document.getElementById('btnDisparo');
const badgeEstado = document.getElementById('badgeEstado');
const contenedorResultado = document.getElementById('contenedorResultado');

btnDisparo.addEventListener('click', function () {
    const valorEntrada = inputDato.value.trim();

    if (valorEntrada === '') {
        alert('Por favor ingrese un dato en la caja de texto antes de disparar el requerimiento.');
        inputDato.focus();
        return;
    }

    // 1. Preparación de los datos usando URLSearchParams (Página 7 del PDF)
    const data = new URLSearchParams();
    data.append('clave', valorEntrada);
    data.append('otraVariable', 'infoAdicional');

    // Alerta pedagógica mostrando cómo viajan los parámetros en el cuerpo POST
    alert("Como seleccionamos el método POST en el requerimiento HTTP, los datos viajan en el body con formato estándar:\n" + data.toString());

    // 2. Configuración del objeto de opciones para Fetch (Página 7 del PDF)
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: data
    };

    // 3. Transición de estado a PENDIENTE (Promesa iniciada)
    badgeEstado.textContent = 'ESPERANDO RESPUESTA (PENDIENTE)...';
    badgeEstado.className = 'estado-promesa estado-pendiente';
    contenedorResultado.innerHTML = '<p style="color: #fbbf24;">Esperando respuesta del servidor (simulando demora con sleep)...</p>';
    btnDisparo.disabled = true;

    // 4. Invocación de la API Fetch nativa (Página 8 del PDF)
    fetch('./respuesta.php', options)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la comunicación con el servidor: ' + response.status);
            }
            // Retorna la promesa de resolución de texto plano/HTML
            return response.text();
        })
        .then(textoDeRespuesta => {
            // Alerta didáctica con el contenido crudo devuelto por el servidor PHP
            alert("Respuesta recibida desde el servidor:\n" + textoDeRespuesta);

            // Transición a estado CUMPLIDO
            badgeEstado.textContent = 'ESTADO: CUMPLIDO';
            badgeEstado.className = 'estado-promesa estado-cumplido';

            // Inyección en el DOM mediante innerHTML sin recargar la página (Página 6)
            contenedorResultado.innerHTML = textoDeRespuesta;
            btnDisparo.disabled = false;
        })
        .catch(error => {
            badgeEstado.textContent = 'ESTADO: RECHAZADO / ERROR';
            badgeEstado.className = 'estado-promesa estado-error';
            contenedorResultado.innerHTML = '<p style="color: #f87171;">Ocurrió un problema de conexión de red: ' + error.message + '</p>';
            btnDisparo.disabled = false;
        });
});