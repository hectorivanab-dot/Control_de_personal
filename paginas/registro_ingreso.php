<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <!-- Esto ayuda a que la página se adapte a celulares y computadores en pocas palabras es el menu hamburguesa -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar ingreso</title>

    <!-- Aquí conectamos el diseño que tenemos en nuestro archivo CSS. 
     Nota: Esto es para recordar como colocar el link a los archivos que esten dentro de una carpeta y no en la raiz del proyecto  -->

    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>

    <!-- El inicio de la página -->
    <header>

        <h1>Control de Personal</h1>

        <p>Registro de ingreso</p>

    </header>


    <!-- Aquí va la parte principal de la página -->
    <main>

        <h2>Registrar ingreso del personal</h2>


        <!-- Formulario donde vamos a ingresar los datos del personal -->
        <form>

            <!-- Nombre de la persona -->
            <label for="nombre">Nombre completo</label>
            <br>

            <input
                type="text"
                id="nombre"
                name="nombre">


            <!-- Número de documento -->
            <br><br>

            <label for="documento">Número de documento</label>
            <br>

            <input
                type="text"
                id="documento"
                name="documento">


            <!-- Área donde trabaja la persona ya sea Administrativa o Operativa-->
            <br><br>

            <label for="area">Área</label>
            <br>

            <select id="area" name="area">
                <option value="">Seleccione un área</option>
                <option value="Administrativa">Administrativa</option>
                <option value="Operativa">Operativa</option>
            </select>


            <!-- Botón para enviar el formulario -->
            <button type="submit">
                Registrar ingreso
            </button>

        </form>

    </main>

</body>

</html>