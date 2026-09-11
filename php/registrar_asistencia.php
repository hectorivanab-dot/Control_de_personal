<?php

// Conectamos con la base de datos
require_once "conexion.php";

// Recibimos el documento enviado por JavaScript
$documento = $_POST["documento"] ?? "";

// Quitamos espacios innecesarios
$documento = trim($documento);


// Comprobamos que se haya recibido un documento
if ($documento === "") {

    echo json_encode([
        "estado" => "error",
        "mensaje" => "No se recibió ningún documento."
    ]);

    exit;
}


// Buscamos al empleado por su documento
$sql = "SELECT * FROM empleados WHERE documento = ?";

$consulta = $conexion->prepare($sql);

$consulta->bind_param("s", $documento);

$consulta->execute();

$resultado = $consulta->get_result();


// Comprobamos si encontramos al empleado
if ($resultado->num_rows === 0) {

    echo json_encode([
        "estado" => "no_encontrado",
        "mensaje" => "El documento no está registrado."
    ]);

    exit;
}


// Guardamos los datos del empleado
$empleado = $resultado->fetch_assoc();

$empleado_id = $empleado["id"];
$nombre = $empleado["nombre"];


// Obtenemos la fecha y hora actuales
$fecha = date("Y-m-d");
$hora = date("H:i:s");


// Buscamos si el empleado ya tiene asistencia registrada hoy
$sql_asistencia = "
    SELECT * FROM asistencias
    WHERE empleado_id = ?
    AND fecha = ?
";

$consulta_asistencia = $conexion->prepare($sql_asistencia);

$consulta_asistencia->bind_param("is", $empleado_id, $fecha);

$consulta_asistencia->execute();

$resultado_asistencia = $consulta_asistencia->get_result();


// Si no existe registro de hoy, registramos la entrada
if ($resultado_asistencia->num_rows === 0) {

    $sql_entrada = "
        INSERT INTO asistencias
        (empleado_id, fecha, hora_entrada)
        VALUES (?, ?, ?)
    ";

    $consulta_entrada = $conexion->prepare($sql_entrada);

    $consulta_entrada->bind_param(
        "iss",
        $empleado_id,
        $fecha,
        $hora
    );

    $consulta_entrada->execute();


    echo json_encode([
        "estado" => "entrada",
        "nombre" => $nombre,
        "hora" => $hora,
        "mensaje" => "Ingreso registrado correctamente."
    ]);


// Si ya existe un registro, revisamos la salida
} else {

    $asistencia = $resultado_asistencia->fetch_assoc();


    // Si todavía no tiene hora de salida
    if ($asistencia["hora_salida"] === null) {

        $sql_salida = "
            UPDATE asistencias
            SET hora_salida = ?
            WHERE id = ?
        ";

        $consulta_salida = $conexion->prepare($sql_salida);

        $consulta_salida->bind_param(
            "si",
            $hora,
            $asistencia["id"]
        );

        $consulta_salida->execute();


        echo json_encode([
            "estado" => "salida",
            "nombre" => $nombre,
            "hora" => $hora,
            "mensaje" => "Salida registrada correctamente."
        ]);


    } else {

        // El empleado ya tiene entrada y salida hoy
        echo json_encode([
            "estado" => "completo",
            "nombre" => $nombre,
            "mensaje" => "Este empleado ya registró entrada y salida hoy."
        ]);
    }
}


$conexion->close();

?>