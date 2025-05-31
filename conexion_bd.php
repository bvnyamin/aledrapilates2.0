<?php
function conexion_bd() {
    $host = "127.0.0.1";
    $usuario = "root";
    $contrasena = "";
    $bd = "aledrapilates_bd";
    $puerto = 3306;

    $conn = new mysqli($host, $usuario, $contrasena, $bd, $puerto);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}
?>
