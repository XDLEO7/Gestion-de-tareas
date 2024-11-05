<?php
$servername = "localhost";  // Cambia esto si es necesario
$username = "root";    // Reemplaza con tu nombre de usuario
$password = ""; // Reemplaza con tu contraseña
$dbname = "tareasDB";        // Reemplaza con el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
