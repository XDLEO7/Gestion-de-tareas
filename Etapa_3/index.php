<?php  
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="topnav">
        <a href="index.php">Inicio</a>
        <a class="active" href="ayuda.php">Ayuda</a>
        <a href="documentacion.php">Documentación</a>
    </div>

    <h1>Lista de Tareas</h1>

    <?php if (isset($_SESSION['mensaje'])) : ?>
        <div class="notification"><?= $_SESSION['mensaje']; ?></div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <div class="actions">
        <a href="insert.php">Crear Nueva Tarea</a>
    </div>

    <?php if ($result->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Título</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Vencimiento</th>
                <th>Categoría</th>
                <th>Completada</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr id="task-<?= $row['id_tarea']; ?>">
                    <td><?= $row['titulo_tarea']; ?></td>
                    <td><?= $row['fecha_inicio']; ?></td>
                    <td><?= $row['fecha_vencimiento']; ?></td>
                    <td><?= $row['nombre_categoria']; ?></td>
                    <td class="<?= $row['tarea_completada'] ? 'completed' : 'not-completed'; ?>">
                        <?= $row['tarea_completada'] ? 'Sí' : 'No'; ?>
                    </td>
                    <td><?= $row['descripcion_tarea']; ?></td>
                    <td class="action-buttons">
                        <a href="update.php?id=<?= $row['id_tarea']; ?>" class="edit-btn">Editar</a>
                        <a href="#" class="delete-btn" onclick="confirmDelete(<?= $row['id_tarea']; ?>)">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>No se encontraron tareas.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>

    <!-- Ventana emergente de confirmación para eliminar -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <p>¿Estás seguro de que deseas eliminar esta tarea?</p>
            <div class="modal-buttons">
                <button class="btn-confirm" onclick="deleteTask()">Confirmar</button>
                <button class="btn-cancel" onclick="closeModal('deleteModal')">Cancelar</button>
            </div>
        </div>
    </div>

    <!-- Ventana emergente para mostrar el mensaje de actualización -->
    <div id="updateModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal('updateModal')">&times;</span>
            <p><?php echo isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : ''; ?></p>
        </div>
    </div>

    <script src="js/scripts.js"></script> <!-- Enlace al archivo JavaScript externo -->
    <script>
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
    </script>
</body>
</html>
