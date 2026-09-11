<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Control de Personal</title>

    <!-- Conectamos el archivo de estilos -->
    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>

    <!-- Encabezado -->
    <header>

        <h1>Control de Personal</h1>

        <p>Registro de ingreso y salida</p>

    </header>


    <!-- Contenido principal -->
    <main>

        <h2>Escanee su cédula</h2>

        <p>
            Acerque su documento al lector para registrar la asistencia.
        </p>


        <!--
            Este campo recibirá automáticamente
            el número que envíe el escáner.
        -->
        <input
            type="text"
            id="documento"
            placeholder="Esperando escaneo..."
            autofocus
        >


        <!-- Aquí mostraremos el resultado -->
        <div id="resultado">

            Esperando que se escanee una cédula...

        </div>

    </main>


    <!-- Conectamos JavaScript -->
<script src="../js/registro.js"></script>

</body>

</html>