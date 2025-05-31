<?php
session_start();
require_once 'conexion_bd.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: inicio_sesion.php");
  exit;
}

$conn = conexion_bd(); // Conexión a base de datos

$id_usuario = $_SESSION['usuario_id'];

// Obtener datos del usuario
$sql_usuario = "SELECT nombre, email FROM usuario WHERE id = ?";  
$stmt = $conn->prepare($sql_usuario);
if (!$stmt) {
  die("Error en prepare usuario: " . $conn->error);
}
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

// Obtener clases reservadas (incluyendo la hora)
$sql_reservas = "SELECT c.tipo AS nombre_clase, r.fechaReserva, r.estado, c.hora, r.id 
                 FROM reserva r
                 JOIN clase c ON r.clase_id = c.id
                 WHERE r.usuario_id = ? AND r.estado = 'confirmada'
                 ORDER BY c.fecha, c.hora";

$stmt = $conn->prepare($sql_reservas);
if (!$stmt) {
  die("Error en preparar reservas: " . $conn->error);
}
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$reservas = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mi Cuenta | Aledra Pilates Studio</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#A8D5BA',
            secondary: '#DCEFE3',
            accent: '#89C9A3'
          }
        }
      }
    };
  </script>
</head>
<body class="bg-secondary text-gray-800 font-sans">
  <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-semibold tracking-wide text-accent">ALEDRA <span class="text-sm font-light block">Pilates Studio</span></h1>
      <nav class="space-x-6 text-gray-700 font-medium">
        <a href="bienvenida2.php" class="hover:underline">Inicio</a>
      </nav>
    </div>
  </header>
  <main class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-accent mb-4">Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?></h2>

    <h3 class="text-xl font-semibold text-gray-700 mb-4">Mis Reservas</h3>

    <?php if ($reservas->num_rows > 0): ?>
      <ul class="space-y-4">
        <?php while ($reserva = $reservas->fetch_assoc()): ?>
          <li class="p-4 border rounded-lg shadow-sm bg-white">
            <h4 class="text-lg font-semibold"><?php echo htmlspecialchars($reserva['nombre_clase']); ?></h4>
            <p class="text-gray-600">Fecha: <?php echo htmlspecialchars($reserva['fechaReserva']); ?></p>
            <p class="text-gray-600">Hora: <?php echo htmlspecialchars($reserva['hora']); ?></p>
            <p class="text-gray-600">Estado: <?php echo htmlspecialchars($reserva['estado']); ?></p>

            <!-- Botón para cancelar la reserva -->
            <form action="cancelar_reserva.php" method="POST" class="mt-2">
              <input type="hidden" name="reserva_id" value="<?php echo htmlspecialchars($reserva['id']); ?>">
              <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Cancelar Reserva
              </button>
            </form>

            <!-- Botón para modificar la reserva -->
            <form action="modificar_reserva.php" method="GET" class="mt-2">
              <input type="hidden" name="reserva_id" value="<?php echo htmlspecialchars($reserva['id']); ?>">
              <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Modificar Reserva
              </button>
            </form>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p class="text-gray-700">No tienes reservas confirmadas.</p>
    <?php endif; ?>
  </main>
</body>
</html>
