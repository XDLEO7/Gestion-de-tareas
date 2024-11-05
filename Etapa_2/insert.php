<?php
include("conexion.php"); // Archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id_categoria = $_POST['id_categoria'];
    $tarea_completada = isset($_POST['tarea_completada']) ? 1 : 0;
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO tareas (titulo_tarea, fecha_inicio, fecha_vencimiento, id_categoria, tarea_completada, descripcion_tarea) 
            VALUES ('$titulo', '$fecha_inicio', '$fecha_vencimiento', '$id_categoria', '$tarea_completada', '$descripcion')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['mensaje'] = "Tarea actualizada exitosamente.";
    header("Location: index.php");
    exit();
} else {
    echo "Error al actualizar la tarea: " . $conn->error;
}

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Tarea</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Enlace al archivo CSS externo -->
</head>
<body>
    <h1>Agregar Tarea</h1>
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
    <select name="id_categoria" required>
        <!-- Supón que tienes una función para listar las categorías -->
        <option value="1">Matemáticas</option>
        <option value="2">Ciencia</option>
        <option value="3">Historia</option>
        <option value="4">Geografía</option>
        <option value="5">Lenguaje</option>
    </select><br>
    <input type="checkbox" name="tarea_completada"> Completada<br>
    <textarea name="descripcion" placeholder="Descripción"></textarea><br>
    <button href= index.php type="submit">Añadir Tarea</button>
</form>
</body>
</html>
