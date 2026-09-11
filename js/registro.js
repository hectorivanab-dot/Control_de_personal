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

        // Comprobamos que se haya recibido un documento
        if (documento === "") {
            resultado.textContent = "No se recibió ningún documento.";
            return;
        }

        // Por ahora solamente mostramos el documento
        resultado.textContent = "Cédula recibida: " + documento;

        // Limpiamos el campo
        campoDocumento.value = "";

        // Dejamos nuevamente el cursor listo para otro escaneo
        campoDocumento.focus();
    }
});