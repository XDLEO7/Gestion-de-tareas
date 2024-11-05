<?php
include("conexion.php"); // Archivo de conexión

// Verificar si se recibió el ID de la tarea
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar los datos actuales de la tarea
    $sql = "SELECT * FROM tareas WHERE id_tarea = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $titulo = $row['titulo_tarea'];
        $fecha_inicio = $row['fecha_inicio'];
        $fecha_vencimiento = $row['fecha_vencimiento'];
        $id_categoria = $row['id_categoria'];
        $tarea_completada = $row['tarea_completada'];
        $descripcion = $row['descripcion_tarea'];
    } else {
        echo "Tarea no encontrada.";
        exit();
    }
} else {
    echo "ID de tarea no especificado.";
    exit();
}

// Actualizar la tarea en la base de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id_categoria = $_POST['id_categoria'];
    $tarea_completada = isset($_POST['tarea_completada']) ? 1 : 0;
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE tareas SET 
                titulo_tarea = '$titulo', 
                fecha_inicio = '$fecha_inicio', 
                fecha_vencimiento = '$fecha_vencimiento', 
                id_categoria = $id_categoria, 
                tarea_completada = $tarea_completada, 
                descripcion_tarea = '$descripcion'
            WHERE id_tarea = $id";



    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Tarea actualizada exitosamente.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la tarea: " . $conn->error;
    }
}

// Obtener categorías para el select
$sql_categorias = "SELECT * FROM categorias";
$result_categorias = $conn->query($sql_categorias);
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
    <h1>Actualizar Tarea</h1>

    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<div class='notification'>" . $_SESSION['mensaje'] . "</div>";
        unset($_SESSION['mensaje']);
    }
    ?>

    <form method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" required>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>

        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $fecha_vencimiento; ?>" required>

        <label for="categoria">Categoría:</label>
        <select id="categoria" name="id_categoria" required>
            <?php
            if ($result_categorias->num_rows > 0) {
                while($cat = $result_categorias->fetch_assoc()) {
                    echo "<option value='" . $cat['id_categoria'] . "'" . ($cat['id_categoria'] == $id_categoria ? " selected" : "") . ">" . $cat['nombre_categoria'] . "</option>";
                }
            }
            ?>
        </select>

        <label for="tarea_completada">¿Completada?</label>
        <input type="checkbox" id="tarea_completada" name="tarea_completada" <?php echo ($tarea_completada ? 'checked' : ''); ?>>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo $descripcion; ?></textarea>

        <button type="submit">Actualizar Tarea</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
