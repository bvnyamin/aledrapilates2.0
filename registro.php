<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a base de datos
$host = "127.0.0.1";
$usuario = "root";
$contraseña = "";
$bd = "aledrapilates_bd";

$conn = new mysqli($host, $usuario, $contraseña, $bd, 3306);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = "";
$exito = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $passwordPlano = $_POST['password'] ?? '';

    // Validación del nombre
    if (!preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre)) {
        $mensaje = "❌ El nombre solo puede contener letras y espacios.";
    } 
    // Validación del teléfono chileno
    elseif (!preg_match('/^\+56\s9\d{8}$/', $telefono)) {
        $mensaje = "❌ El número debe tener formato chileno: +56 9xxxxxxxx";
    } 
    else {
        $password = password_hash($passwordPlano, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nombre, email, telefono, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $nombre, $correo, $telefono, $password);
            if ($stmt->execute()) {
                $mensaje = "✅ ¡Registro exitoso! Serás redirigido al login...";
                $exito = true;
                header("refresh:2;url=inicio_sesion.html");
            } else {
                $mensaje = "❌ Error al registrar: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensaje = "❌ Error en la preparación de la consulta.";
        }
    }
}

$conn->close();
?>
