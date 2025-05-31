<?php
require_once 'conexion_bd.php'; // Incluir la conexión a la base de datos

$conn = conexion_bd(); // Establecer la conexión

// Consultar las instructoras disponibles en la base de datos
$sql_instructoras = "SELECT id, nombre FROM instructora";
$stmt = $conn->prepare($sql_instructoras);
$stmt->execute();
$result_instructoras = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserva de Clases - Aledra Pilates</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-amber-100 min-h-screen">
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-center text-teal-800 mb-8">Reserva tu Clase</h1>

    <!-- Descripción de Planes -->
    <section class="mb-10">
      <h2 class="text-xl font-semibold text-teal-700 mb-4">Planes Disponibles</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-4 rounded-lg shadow">
          <h3 class="text-lg font-bold text-teal-800">Plan Trimestral</h3>
          <p>Acceso durante 90 días. Ideal para compromiso sostenido.</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <h3 class="text-lg font-bold text-teal-800">Plan Semestral</h3>
          <p>Acceso durante 180 días. Ahorro a largo plazo.</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <h3 class="text-lg font-bold text-teal-800">Plan Anual</h3>
          <p>Acceso durante 365 días. Incluye beneficios exclusivos.</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
          <h3 class="text-lg font-bold text-teal-800">Plan Hora Valle</h3>
          <p>Descuento en horarios con baja demanda. Clases entre 11 AM - 12 PM y 17 PM - 18 PM.</p>
        </div>
      </div>
    </section>

    <!-- Formulario de Reserva -->
    <section>
      <h2 class="text-xl font-semibold text-teal-700 mb-4">Selecciona tu Clase</h2>
      <form action="procesar_reserva.php" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">

        <!-- Selección de Instructora -->
        <div>
          <label for="instructora" class="block font-medium mb-1">Instructora</label>
          <select name="instructora" id="instructora" class="w-full border border-gray-300 rounded px-3 py-2" required>
            <option value="">Selecciona una instructora</option>
            <?php
            while ($row = $result_instructoras->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
            }
            ?>
          </select>
        </div>

        <!-- Selección de Plan -->
        <div>
          <label for="plan" class="block font-medium mb-1">Plan</label>
          <select name="plan" id="plan" required class="w-full border border-gray-300 rounded px-3 py-2">
            <option value="">Selecciona un plan</option>
            <?php
            $sql_planes = "SELECT id, nombre FROM plan";
            $result_planes = $conn->query($sql_planes);

            if ($result_planes && $result_planes->num_rows > 0) {
                while ($row = $result_planes->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                }
            } else {
                echo "<option disabled>No hay planes disponibles</option>";
            }
            ?>
          </select>
        </div>

        <!-- Selección de Fecha -->
        <div>
          <label for="fecha" class="block font-medium mb-1">Fecha</label>
          <input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <!-- Selección de Hora -->
        <div>
          <label for="hora" class="block font-medium mb-1">Hora</label>
          <select name="hora" id="hora" class="w-full border border-gray-300 rounded px-3 py-2">
            <option value="08:00">08:00</option>
            <option value="09:00">09:00</option>
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
          </select>
        </div>

        <div class="text-center">
          <button type="submit" class="bg-teal-700 text-white px-6 py-2 rounded hover:bg-teal-800">
            <i class="fas fa-calendar-check me-2"></i> Reservar Clase
          </button>
        </div>
      </form>
    </section>

    <div class="text-center mt-8">
      <a href="bienvenida2.php" class="inline-block text-teal-700 hover:underline text-lg">
        ← Volver al menú principal
      </a>
    </div>
  </div>
</body>
</html>
