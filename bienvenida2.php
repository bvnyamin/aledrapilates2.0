<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: inicio_sesion.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aledra Pilates Studio</title>
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
<body class="font-sans text-gray-800 bg-secondary">
  <!-- Navbar -->
  <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-xl font-semibold tracking-wide text-accent">ALEDRA <span class="text-sm font-light block">Pilates Studio</span></h1>
      <nav class="flex items-center space-x-6 text-gray-700 font-medium">
        <a href="bienvenida2.php">Inicio</a>
        <a href="#nosotros">Sobre Nosotros</a>
        <a href="#planes">Planes</a>
        <a href="reserva.php">Reserva</a>
        <a href="#contacto">Contacto</a>
        <a href="vista_usuario.php" class="bg-primary text-white px-4 py-2 rounded hover:bg-accent transition">Cuenta</a>
      <a href="logout.php" class="text-red-600 hover:underline">Cerrar sesión</a>
        </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="relative">
    <img src="https://images.unsplash.com/photo-1605276374123-53dd20dca4c2" alt="Pilates" class="w-full h-[450px] object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-30 flex flex-col justify-center items-start p-10 text-white">
      <h2 class="text-4xl font-semibold mb-4 max-w-xl">Encuentra equilibrio entre cuerpo y mente</h2>
      <a href="reserva.php" class="bg-primary text-white px-5 py-2 rounded shadow-md hover:bg-accent transition">Agenda tu clase ahora</a>
    </div>
  </section>

  <!-- Bienvenida -->
  <section class="py-12 px-6" id="nosotros">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-8">
      <img src="https://images.unsplash.com/photo-1590080877011-98a306d87ca1" alt="Instructores" class="w-full md:w-1/3 rounded-lg shadow">
      <div>
        <h3 class="text-2xl font-semibold mb-2 text-accent">Bienvenida</h3>
        <p class="text-gray-700">Aledra Pilates Studio es un espacio dedicado a tu bienestar y salud. Alejandra y Andrea, tus instructoras certificadas, te guiarán en un camino hacia una vida más consciente y activa.</p>
      </div>
    </div>
  </section>

  <!-- Planes -->
  <section class="py-16 bg-white text-center" id="planes">
    <h3 class="text-3xl font-semibold mb-10 text-accent">Planes y Tarifas</h3>
    <div class="flex justify-center flex-wrap gap-6 px-4">
      <div class="border p-6 rounded-lg shadow-sm w-full sm:w-40 bg-secondary">
        <h4 class="text-lg font-medium mb-2">Mensual</h4>
        <a href="#" class="bg-primary text-white px-4 py-1 rounded hover:bg-accent">Ver más detalles</a>
      </div>
      <div class="border p-6 rounded-lg shadow-sm w-full sm:w-40 bg-secondary">
        <h4 class="text-lg font-medium mb-2">Trimestral</h4>
        <a href="#" class="bg-primary text-white px-4 py-1 rounded hover:bg-accent">Ver más detalles</a>
      </div>
      <div class="border p-6 rounded-lg shadow-sm w-full sm:w-40 bg-secondary">
        <h4 class="text-lg font-medium mb-2">Semestral</h4>
        <a href="#" class="bg-primary text-white px-4 py-1 rounded hover:bg-accent">Ver más detalles</a>
      </div>
      <div class="border p-6 rounded-lg shadow-sm w-full sm:w-40 bg-secondary">
        <h4 class="text-lg font-medium mb-2">Anual</h4>
        <a href="#" class="bg-primary text-white px-4 py-1 rounded hover:bg-accent">Ver más detalles</a>
      </div>
    </div>
  </section>

  <!-- Reserva -->
  <section class="py-16 px-6 bg-secondary" id="reserva">
    <div class="max-w-3xl mx-auto">
      <h3 class="text-3xl font-semibold text-center mb-8 text-accent">Reserva tu Clase</h3>
      <form action="procesar_reserva.php" method="POST" class="bg-white p-8 rounded-lg shadow-md space-y-6">
        <div>
          <label class="block mb-1 font-medium">Nombre completo</label>
          <input type="text" name="nombre" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div>
          <label class="block mb-1 font-medium">Correo electrónico</label>
          <input type="email" name="correo" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div class="md:flex md:space-x-4">
          <div class="md:w-1/2">
            <label class="block mb-1 font-medium">Fecha</label>
            <input type="date" name="fecha" class="w-full border border-gray-300 rounded px-4 py-2" required>
          </div>
          <div class="md:w-1/2 mt-4 md:mt-0">
            <label class="block mb-1 font-medium">Hora</label>
            <input type="time" name="hora" class="w-full border border-gray-300 rounded px-4 py-2" required>
          </div>
        </div>
        <div>
          <label class="block mb-1 font-medium">Tipo de clase</label>
          <select name="tipo" class="w-full border border-gray-300 rounded px-4 py-2">
            <option>Reformer</option>
            <option>Mat Pilates</option>
            <option>Clase privada</option>
          </select>
        </div>
        <button type="submit" class="bg-accent text-white px-6 py-2 rounded hover:bg-primary transition">Reservar ahora</button>
      </form>
    </div>
  </section>

  <!-- Contacto -->
  <section class="py-16 px-6 bg-white" id="contacto">
    <div class="max-w-3xl mx-auto text-center">
      <h3 class="text-3xl font-semibold mb-6 text-accent">Contacto</h3>
      <p class="mb-6 text-gray-600">¿Tienes alguna duda? Escríbenos y te responderemos pronto.</p>
      <form class="bg-secondary p-6 rounded-lg shadow space-y-4 text-left">
        <div>
          <label class="block font-medium mb-1">Nombre</label>
          <input type="text" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div>
          <label class="block font-medium mb-1">Correo electrónico</label>
          <input type="email" class="w-full border border-gray-300 rounded px-4 py-2" required>
        </div>
        <div>
          <label class="block font-medium mb-1">Mensaje</label>
          <textarea rows="4" class="w-full border border-gray-300 rounded px-4 py-2" required></textarea>
        </div>
        <button type="submit" class="bg-accent text-white px-6 py-2 rounded hover:bg-primary transition">Enviar mensaje</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-accent text-white text-center py-6 mt-10">
    <p>&copy; 2025 Aledra Pilates Studio. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
