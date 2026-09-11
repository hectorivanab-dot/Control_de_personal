<?php

// Datos para conectarnos a la base de datos
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "control_personal";

// Creamos la conexión
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Comprobamos si hubo algún problema
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configuramos los caracteres para que acepte tildes y ñ
$conexion->set_charset("utf8mb4");

?>