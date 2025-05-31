<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'conexion_bd.php';
require_once 'vendor/autoload.php'; // Autoload de Composer para Twilio

use Twilio\Rest\Client;

$conn = conexion_bd();

$twilioSid = 'ACff42215ac058777a8c8fe2ee6566cb8e';
$twilioToken = '5e45a16bad83627d92c0f562ee6e99d2';
$twilioNumber = '+18483432772';
$twilioClient = new Client($twilioSid, $twilioToken);

if (!isset($_SESSION['usuario_id'])) {
    header("Location: inicio_sesion.php");
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$instructora_id = $_POST['instructora'] ?? null;
$plan_id = $_POST['plan'] ?? null;
$fecha = $_POST['fecha'] ?? null;
$hora = $_POST['hora'] ?? null;

if (!$instructora_id || !$fecha || !$hora || !$plan_id) {
    die("Faltan datos para procesar la reserva.");
}

$sql_clase = "SELECT * FROM clase WHERE fecha = ? AND hora = ? AND id_instructora = ?";
$stmt = $conn->prepare($sql_clase);
if (!$stmt) {
    die("Error en prepare (consulta clase): " . $conn->error);
}
$stmt->bind_param("ssi", $fecha, $hora, $instructora_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $cupos_maximos = 6;
    $tipo = "Clase de Pilates";
    $sql_insert = "INSERT INTO clase (tipo, fecha, hora, id_instructora, cupoMaximo) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    if (!$stmt_insert) {
        die("Error en prepare (insertar clase): " . $conn->error);
    }
    $stmt_insert->bind_param("sssii", $tipo, $fecha, $hora, $instructora_id, $cupos_maximos);
    $stmt_insert->execute();
    $clase_id = $stmt_insert->insert_id;
    $stmt_insert->close();
} else {
    $clase = $result->fetch_assoc();
    $clase_id = $clase['id'];
}

$sql_cupos = "SELECT COUNT(*) AS total FROM reserva WHERE clase_id = ? AND estado = 'confirmada'";
$stmt = $conn->prepare($sql_cupos);
if (!$stmt) {
    die("Error en prepare (verificar cupos): " . $conn->error);
}
$stmt->bind_param("i", $clase_id);
$stmt->execute();
$result = $stmt->get_result();
$total = $result->fetch_assoc()['total'];

if ($total >= 6) {
    die("Esta clase ya está llena.");
}

$sql_reserva = "INSERT INTO reserva (fechaReserva, estado, clase_id, usuario_id, horaReserva, plan_id)
                VALUES (?, 'confirmada', ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_reserva);
if (!$stmt) {
    die("Error en prepare (insertar reserva): " . $conn->error);
}
$stmt->bind_param("siiss", $fecha, $clase_id, $id_usuario, $hora, $plan_id);

if (!$stmt->execute()) {
    die("Error al ejecutar la reserva: " . $stmt->error);
}

if ($stmt->affected_rows > 0) {
    $sql_detalles = "SELECT c.tipo AS nombre_clase, c.fecha AS clase_fecha, c.hora AS clase_hora, i.nombre AS instructora_nombre, u.telefono AS telefono_usuario
                     FROM clase c
                     JOIN instructora i ON c.id_instructora = i.id
                     JOIN usuario u ON u.id = ?
                     WHERE c.id = ?";
    $stmt_detalles = $conn->prepare($sql_detalles);
    $stmt_detalles->bind_param("ii", $id_usuario, $clase_id);
    $stmt_detalles->execute();
    $result_detalles = $stmt_detalles->get_result();
    $detalle = $result_detalles->fetch_assoc();

    $telefono = preg_replace('/\D/', '', $detalle['telefono_usuario']);
    $telefonoFormateado = (str_starts_with($telefono, '56')) ? "+$telefono" : "+56$telefono";

    $mensajeSMS = "Reserva Confirmada:\nClase: {$detalle['nombre_clase']}\nFecha: {$detalle['clase_fecha']}\nHora: {$detalle['clase_hora']}\nInstructora: {$detalle['instructora_nombre']}";
    try {
        $twilioClient->messages->create(
            $telefonoFormateado,
            [
                'from' => $twilioNumber,
                'body' => $mensajeSMS
            ]
        );
    } catch (Exception $e) {
        error_log("Error al enviar SMS: " . $e->getMessage());
    }

    header("Location: vista_usuario.php");
    exit();
} else {
    echo "<script>alert('Hubo un error al registrar la reserva.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
