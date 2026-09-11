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


// Buscamos el empleado por su documento
$sql = "SELECT * FROM empleados WHERE documento = ?";

$consulta = $conexion->prepare($sql);

$consulta->bind_param("s", $documento);

$consulta->execute();

$resultado = $consulta->get_result();


// Comprobamos si encontramos al empleado
if ($resultado->num_rows > 0) {

    $empleado = $resultado->fetch_assoc();

    echo json_encode([
        "estado" => "ok",
        "empleado" => $empleado
    ]);

} else {

    echo json_encode([
        "estado" => "no_encontrado",
        "mensaje" => "El documento no está registrado."
    ]);
}


$consulta->close();
$conexion->close();

?>