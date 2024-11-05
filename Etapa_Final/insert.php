<?php
session_start();
include("conexion.php"); // Archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id_categoria = $_POST['id_categoria'];
    $id_prioridad = $_POST['id_prioridad']; // Nueva columna de prioridad
    $tarea_completada = isset($_POST['tarea_completada']) ? 1 : 0;
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO tareas (titulo_tarea, fecha_inicio, fecha_vencimiento, id_categoria, id_prioridad, tarea_completada, descripcion_tarea) 
            VALUES ('$titulo', '$fecha_inicio', '$fecha_vencimiento', '$id_categoria', '$id_prioridad', '$tarea_completada', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Tarea añadida exitosamente.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al añadir la tarea: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Tarea</title>
    <link rel="stylesheet" href="css/agregar.css"> <!-- Enlace al archivo CSS externo -->
</head>
<body>

<?php
    if (isset($_SESSION['mensaje'])) {
        echo "<div class='notification'>" . $_SESSION['mensaje'] . "</div>";
        unset($_SESSION['mensaje']);
    }
?>

<form method="POST" action="insert.php">
    <input type="text" name="titulo" placeholder="Título" required><br>
    <input type="date" name="fecha_inicio" required><br>
    <input type="date" name="fecha_vencimiento" required><br>
    
    <!-- Selección de categoría -->
    <select name="id_categoria" required>
        <option value="1">Matemáticas</option>
        <option value="2">Ciencia</option>
        <option value="3">Historia</option>
        <option value="4">Geografía</option>
        <option value="5">Lenguaje</option>
    </select><br>
    
    <!-- Nueva selección de prioridad -->
    <select name="id_prioridad" required>
        <option value="1">Urgente</option>
        <option value="2">Media</option>
        <option value="3">Baja</option>
    </select><br>
    
    <div class="checkbox-container">
        <input type="checkbox" name="tarea_completada">
        <label>Completada</label>
    </div>
    
    <textarea name="descripcion" placeholder="Descripción"></textarea><br>
    <button type="submit">Añadir Tarea</button>
    <a href="index.php" class="cancel-btn">Cancelar</a> <!-- Botón de Cancelar -->
</form>
</body>
</html>
