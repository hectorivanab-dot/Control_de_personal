// Obtenemos el campo donde llegará el número de documento
const campoDocumento = document.getElementById("documento");

// Obtenemos el lugar donde mostraremos los mensajes
const resultado = document.getElementById("resultado");


// Detectamos cuando se presiona una tecla
campoDocumento.addEventListener("keydown", function(evento) {

    // El escáner normalmente termina el número con Enter
    if (evento.key === "Enter") {

        // Evitamos que la página se recargue
        evento.preventDefault();

        // Guardamos el documento recibido
        const documento = campoDocumento.value.trim();


        // Comprobamos que haya un documento
        if (documento === "") {

            resultado.textContent = "No se recibió ningún documento.";

            return;
        }


        // Mostramos que estamos buscando al empleado
        resultado.textContent = "Buscando empleado...";


        // Enviamos el documento a PHP
        fetch("../php/consultar_empleado.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },

            body: "documento=" + encodeURIComponent(documento)

        })


        // Recibimos la respuesta de PHP
        .then(respuesta => respuesta.json())


        // Procesamos la información recibida
        .then(datos => {

            if (datos.estado === "ok") {

                // Mostramos el nombre del empleado
                resultado.textContent =
                    "Empleado encontrado: " +
                    datos.empleado.nombre;

            } else {

                // Mostramos el mensaje de error
                resultado.textContent = datos.mensaje;
            }


            // Limpiamos el campo
            campoDocumento.value = "";

            // Dejamos nuevamente el cursor listo
            campoDocumento.focus();

        })


        // Si ocurre algún problema de conexión
        .catch(error => {

            resultado.textContent =
                "Ocurrió un error al consultar el empleado.";

            console.error(error);

        });

    }

});