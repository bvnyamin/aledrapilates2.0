<?php
session_start();
require_once 'conexion_bd.php'; // Incluir la conexión a la base de datos

$conn = conexion_bd(); // Establecer la conexión

// Verificar si la conexión a la base de datos es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión a la base de datos exitosa.<br>";
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: inicio_sesion.php");
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$reserva_id = $_POST['reserva_id'] ?? null;
$nueva_fecha = $_POST['fecha'] ?? null;
$nueva_hora = $_POST['hora'] ?? null;

if (!$reserva_id || !$nueva_fecha || !$nueva_hora) {
    die("Faltan datos para modificar la reserva.");
}

// Depuración: Verificar que los datos se están recibiendo correctamente
echo "Reserva ID: " . htmlspecialchars($reserva_id) . "<br>";
echo "Nueva Fecha: " . htmlspecialchars($nueva_fecha) . "<br>";
echo "Nueva Hora: " . htmlspecialchars($nueva_hora) . "<br>";

// 1. Actualizamos la clase en la tabla `clase` con la nueva fecha y hora
$sql_modificar_clase = "UPDATE clase 
                        SET fecha = ?, hora = ? 
                        WHERE id = (SELECT clase_id FROM reserva WHERE id = ? AND usuario_id = ? AND estado = 'confirmada')";

$stmt_clase = $conn->prepare($sql_modificar_clase);

if (!$stmt_clase) {
    die("Error al preparar la consulta para clase: " . $conn->error);
}

$stmt_clase->bind_param("ssii", $nueva_fecha, $nueva_hora, $reserva_id, $id_usuario);
$stmt_clase->execute();

// Verificar si la actualización en la tabla `clase` fue exitosa
if ($stmt_clase->affected_rows <= 0) {
    die("No se pudo actualizar la clase.");
}

// 2. Ahora actualizamos la tabla `reservas` para reflejar la nueva fecha y hora de la reserva
$sql_modificar_reserva = "UPDATE reserva 
                          SET fechaReserva = ?, horaReserva = ? 
                          WHERE id = ? AND usuario_id = ? AND estado = 'confirmada'";

$stmt_reserva = $conn->prepare($sql_modificar_reserva);

if (!$stmt_reserva) {
    die("Error al preparar la consulta para reserva: " . $conn->error); // Mostrar el error de preparación
}

$stmt_reserva->bind_param("ssii", $nueva_fecha, $nueva_hora, $reserva_id, $id_usuario);
$stmt_reserva->execute();

// Verificar si la actualización en la tabla `reservas` fue exitosa
if ($stmt_reserva->affected_rows > 0) {
    echo "<script>alert('Reserva modificada con éxito.'); window.location.href='vista_usuario.php';</script>";
} else {
    echo "<script>alert('No se pudo modificar la reserva.'); window.history.back();</script>";
}

$stmt_reserva->close();
$stmt_clase->close();
$conn->close();
?>
