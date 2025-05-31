<?php
session_start();
require_once 'conexion_bd.php';  // Incluir la conexión a la base de datos

$conn = conexion_bd();  // Establecer la conexión

if (!isset($_SESSION['usuario_id'])) {
    header("Location: inicio_sesion.php");
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$reserva_id = $_POST['reserva_id'] ?? null;

if (!$reserva_id) {
    die("Faltan datos para cancelar la reserva.");
}

// Verificar si la reserva pertenece al usuario
$sql_verificar_reserva = "SELECT id FROM reserva WHERE id = ? AND usuario_id = ? AND estado = 'confirmada'";
$stmt = $conn->prepare($sql_verificar_reserva);
$stmt->bind_param("ii", $reserva_id, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No puedes cancelar esta reserva.");
}

// Cancelar reserva
$sql_cancelar = "UPDATE reserva SET estado = 'cancelada' WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sql_cancelar);
$stmt->bind_param("ii", $reserva_id, $id_usuario);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<script>alert('Reserva cancelada exitosamente.'); window.location.href='vista_usuario.php';</script>";
} else {
    echo "<script>alert('No se pudo cancelar la reserva.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
