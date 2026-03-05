<?php

$conexion = new mysqli("localhost", "root", "", "crud_productos");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>