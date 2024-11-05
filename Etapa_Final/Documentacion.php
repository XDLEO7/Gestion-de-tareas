<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/documentacion.css">
    <title>Documentación del Proyecto</title>
</head>
<body>
    <div class="topnav">
        <a href="calendario.php">Inicio</a>
        <a href="index.php">Administrar tareas</a>
        <a href="ayuda.php">Ayuda</a>
        <a href="documentacion.php">Documentación</a>
    </div>

    <div class="content">
        <h1>Documentación del Proyecto Web de Gestión de Tareas</h1>
        
        <h2>Introducción</h2>
        <p>Este proyecto web tiene como objetivo proporcionar una interfaz simple para gestionar tareas. Los usuarios pueden crear, editar, eliminar y visualizar tareas en una base de datos. La aplicación está desarrollada en PHP y utiliza una base de datos MySQL para el almacenamiento de datos.</p>
        
        <h2>Estructura del Proyecto</h2>
        <ul>
            <li><strong>conexion.php:</strong> Archivo que establece la conexión con la base de datos.</li>
            <li><strong>delete.php:</strong> Archivo que maneja la eliminación de tareas.</li>
            <li><strong>index.php:</strong> Página principal que muestra la lista de tareas.</li>
            <li><strong>insert.php:</strong> Página que permite crear nuevas tareas.</li>
            <li><strong>update.php:</strong> Página que permite editar tareas existentes.</li>
        </ul>
        
        <h2>Arquitectura del Sistema</h2>
        <p>La arquitectura del sistema sigue un modelo MVC (Modelo-Vista-Controlador), donde:</p>
        <ul>
            <li><strong>Modelo:</strong> Representa la lógica de datos, interactuando con la base de datos.</li>
            <li><strong>Vista:</strong> Presenta la interfaz de usuario y se encarga de la visualización de datos.</li>
            <li><strong>Controlador:</strong> Gestiona la interacción del usuario y actualiza el modelo y la vista en consecuencia.</li>
        </ul>
        
        <h2>Código Fuente</h2>
        <h3>1. conexion.php</h3>
        <p>Este archivo establece la conexión con la base de datos.</p>
        <pre>
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
        </pre>

        <h3>3. index.php</h3>
        <p>Muestra la lista de tareas y proporciona enlaces para crear y eliminar tareas.</p>
        <pre>
session_start();
include("conexion.php");

$sql = "SELECT tareas.id_tarea, 
               tareas.titulo_tarea, 
               tareas.fecha_inicio, 
               tareas.fecha_vencimiento, 
               categorias.nombre_categoria, 
               tareas.tarea_completada, 
               tareas.descripcion_tarea 
        FROM tareas 
        JOIN categorias ON tareas.id_categoria = categorias.id_categoria";

$result = $conn->query($sql);

DOCTYPE html
html lang="es"
head
    meta charset="UTF-8"
    meta name="viewport" content="width=device-width, initial-scale=1.0"
    
head
body
    div class="topnav"
        a href="index.php" Inicio /a
        a class="active" href="ayuda.php" Ayuda /a
        a href="documentacion.php" Documentación /a
    div

    h1 Lista de Tareas /h1

    if (isset($_SESSION['mensaje'])) 
        div class="notification" ?= $_SESSION['mensaje']; ?> /div
        unset($_SESSION['mensaje']); 
    endif

    div class="actions"
        a href="insert.php" Crear Nueva Tarea /a
    div

    if ($result->num_rows > 0) 
        table
            tr
                th Título /th
                th Fecha de Inicio /th
                th Fecha de Vencimiento /th
                th Categoría /th
                th Completada /th
                th Descripción /th
                th Acciones /th
            tr
            while ($row = $result->fetch_assoc()) 
                tr id="task-= $row['id_tarea']; ?>"
                    td ?= $row['titulo_tarea']; ?> /td
                    td ?= $row['fecha_inicio']; ?> /td
                    td ?= $row['fecha_vencimiento']; ?> /td
                    td ?= $row['nombre_categoria']; ?> /td
                    td class="?= $row['tarea_completada'] ? 'completed' : 'not-completed'; ?>"
                        ?= $row['tarea_completada'] ? 'Sí' : 'No'; ?>
                    /td
                    td ?= $row['descripcion_tarea']; ?> /td
                    td class="action-buttons"
                        a href="update.php?id=?= $row['id_tarea']; ?>" class="edit-btn" Editar /a
                        a href="#" class="delete-btn" onclick="confirmDelete(?= $row['id_tarea']; ?>)">Eliminar /a
                    /td
                /tr
            endwhile
        /table
    else 
        p No se encontraron tareas. /p
    endif

    $conn->close();

    div id="deleteModal" class="modal"
        div class="modal-content"
            p ¿Estás seguro de que deseas eliminar esta tarea? /p
            div class="modal-buttons"
                button class="btn-confirm" onclick="deleteTask()" Confirmar /button
                button class="btn-cancel" onclick="closeModal('deleteModal')" Cancelar /button
            div
        div
    div

    div id="updateModal" class="modal" style="display: none;"
        div class="modal-content"
            span class="close" onclick="closeModal('updateModal')"  /span
            p < echo isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : ''; ?> /p
        div
    div

    script src="js/scripts.js" /script
    script
        let taskIdToDelete;

        function confirmDelete(taskId) {
            taskIdToDelete = taskId; // Guardar el ID de la tarea a eliminar
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function deleteTask() {
            // Realizar la solicitud AJAX para eliminar la tarea
            fetch(`delete.php?id=${taskIdToDelete}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (response.ok) {
                    // Eliminar la fila de la tabla
                    document.getElementById(`task-${taskIdToDelete}`).remove();
                    closeModal('deleteModal');
                } else {
                    alert("Error al eliminar la tarea.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Error al eliminar la tarea.");
            });
        }
    /script
/body
/html

        </pre>

        <h3>4. insert.php</h3>
        <p>Permite al usuario crear nuevas tareas.</p>
        <pre>
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

DOCTYPE html
html lang="es"
head
    meta charset="UTF-8"
    meta name="viewport" content="width=device-width, initial-scale=1.0"
    title Actualizar Tarea /title
     
head
body
    h1 Agregar Tarea /h1
    if (isset($_SESSION['mensaje'])) 
        div class="notification" ?= $_SESSION['mensaje']; ?> /div
        unset($_SESSION['mensaje']); 
    endif

    form method="POST"
        label for="titulo" Título: /label
        input type="text" name="titulo" required id="titulo" / 
        label for="fecha_inicio" Fecha de Inicio: /label
        input type="date" name="fecha_inicio" required id="fecha_inicio" / 
        label for="fecha_vencimiento" Fecha de Vencimiento: /label
        input type="date" name="fecha_vencimiento" required id="fecha_vencimiento" / 
        label for="id_categoria" Categoría: /label
        select name="id_categoria" required id="id_categoria"
            // Llenar las categorías desde la base de datos
            // Supongamos que ya tenemos un arreglo $categorias
            foreach ($categorias as $categoria)
                option value="?= $categoria['id_categoria']; ?>" ?= $categoria['nombre_categoria']; ?> /option
            endforeach
        select
        label for="descripcion" Descripción: /label
        textarea name="descripcion" id="descripcion" rows="4" / /textarea
        input type="checkbox" name="tarea_completada" id="tarea_completada" / 
        label for="tarea_completada" Tarea Completada /label
        button type="submit" Crear Tarea /button
    form
/body
/html
        </pre>

        <h3>5. update.php</h3>
        <p>Permite al usuario editar tareas existentes.</p>
        <pre>
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_tarea = $_POST['id_tarea'];
    $titulo = $_POST['titulo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $id_categoria = $_POST['id_categoria'];
    $tarea_completada = isset($_POST['tarea_completada']) ? 1 : 0;
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE tareas SET titulo_tarea='$titulo', 
                              fecha_inicio='$fecha_inicio', 
                              fecha_vencimiento='$fecha_vencimiento', 
                              id_categoria='$id_categoria', 
                              tarea_completada='$tarea_completada', 
                              descripcion_tarea='$descripcion' 
            WHERE id_tarea='$id_tarea'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Tarea actualizada exitosamente.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la tarea: " . $conn->error;
    }

    $conn->close();
}

$id_tarea = $_GET['id'];
$sql = "SELECT * FROM tareas WHERE id_tarea='$id_tarea'";
$result = $conn->query($sql);
$tarea = $result->fetch_assoc();

DOCTYPE html
html lang="es"
head
    meta charset="UTF-8"
    meta name="viewport" content="width=device-width, initial-scale=1.0"
    title Actualizar Tarea /title
    
head
body
    h1 Actualizar Tarea /h1
    if (isset($_SESSION['mensaje'])) 
        div class="notification" ?= $_SESSION['mensaje']; ?> /div
        unset($_SESSION['mensaje']); 
    endif

    form method="POST"
        input type="hidden" name="id_tarea" value="?= $tarea['id_tarea']; ?>" / 
        label for="titulo" Título: /label
        input type="text" name="titulo" value="?= $tarea['titulo_tarea']; ?>" required id="titulo" / 
        label for="fecha_inicio" Fecha de Inicio: /label
        input type="date" name="fecha_inicio" value="?= $tarea['fecha_inicio']; ?>" required id="fecha_inicio" / 
        label for="fecha_vencimiento" Fecha de Vencimiento: /label
        input type="date" name="fecha_vencimiento" value="?= $tarea['fecha_vencimiento']; ?>" required id="fecha_vencimiento" / 
        label for="id_categoria" Categoría: /label
        select name="id_categoria" required id="id_categoria"
            foreach ($categorias as $categoria)
                option value="?= $categoria['id_categoria']; ?>" ?= $categoria['nombre_categoria']; ?> /option
            endforeach
        select
        label for="descripcion" Descripción: /label
        textarea name="descripcion" id="descripcion" rows="4" ?= $tarea['descripcion_tarea']; ?> /textarea
        input type="checkbox" name="tarea_completada" id="tarea_completada" ?= $tarea['tarea_completada'] ? 'checked' : ''; ?> / 
        label for="tarea_completada" Tarea Completada /label
        button type="submit" Actualizar Tarea /button
    form
/body
/html
        </pre>
    </div>
</body>
</html>
