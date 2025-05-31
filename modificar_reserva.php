<?php
session_start();
require_once 'conexion_bd.php'; // Conexión a la base de datos

$conn = conexion_bd(); // Establecer la conexión

if (!isset($_SESSION['usuario_id'])) {
    header("Location: inicio_sesion.php");
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$reserva_id = $_GET['reserva_id'] ?? null;

if (!$reserva_id) {
    die("Faltan datos para modificar la reserva.");
}

// Obtener los datos de la reserva para mostrar los valores actuales
$sql_reserva = "SELECT r.id, c.fecha, c.hora
                FROM reserva r
                JOIN clase c ON r.clase_id = c.id
                WHERE r.id = ? AND r.usuario_id = ? AND r.estado = 'confirmada'";

$stmt = $conn->prepare($sql_reserva);
$stmt->bind_param("ii", $reserva_id, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Reserva no encontrada o no puedes modificar esta reserva.");
}

$reserva = $result->fetch_assoc();

// Mostrar el formulario para modificar la fecha y hora de la reserva
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Modificar Reserva | Aledra Pilates Studio</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-secondary text-gray-800 font-sans">
  <div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-semibold text-accent mb-4">Modificar Reserva</h2>

    <form action="procesar_modificacion.php" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">
      <input type="hidden" name="reserva_id" value="<?php echo htmlspecialchars($reserva['id']); ?>">

      <div>
        <label for="fecha" class="block font-medium mb-1">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($reserva['fecha']); ?>" class="w-full border border-gray-300 rounded px-3 py-2" required>
      </div>

      <div>
        <label for="hora" class="block font-medium mb-1">Hora</label>
        <input type="time" name="hora" id="hora" value="<?php echo htmlspecialchars($reserva['hora']); ?>" class="w-full border border-gray-300 rounded px-3 py-2" required>
      </div>

      <div class="text-center">
        <button type="submit" class="bg-teal-700 text-white px-6 py-2 rounded hover:bg-teal-800">
          Modificar Reserva
        </button>
      </div>
    </form>
  </div>
</body>
</html>
