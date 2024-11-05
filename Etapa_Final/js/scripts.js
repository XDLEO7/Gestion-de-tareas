let deleteId = null;

// Mostrar el modal de confirmación
function confirmDelete(id) {
    deleteId = id;
    document.getElementById('deleteModal').style.display = 'block';
}

// Cerrar el modal
function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
    deleteId = null;
}
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
    fetch('delete.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({ id: taskIdToDelete }) // Enviar el ID en el cuerpo de la solicitud
    })
    .then(response => response.json()) // Parsear la respuesta como JSON
    .then(data => {
        if (data.success) {
            // Eliminar la fila de la tabla
            document.getElementById(`task-${taskIdToDelete}`).remove();
            closeModal('deleteModal');
            alert("Tarea eliminada exitosamente."); // Mensaje opcional de confirmación
        } else {
            alert("Error al eliminar la tarea: " + (data.error || "Error desconocido."));
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Error al eliminar la tarea.");
    });
}


function confirmDelete(id) {
    taskToDelete = id; // Guardar el ID de la tarea a eliminar
    document.getElementById('deleteModal').style.display = 'block'; // Mostrar el modal de eliminación
}


function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none'; // Cerrar el modal
}

function openUpdateModal() {
    document.getElementById('updateModal').style.display = 'block'; // Mostrar el modal de actualización
}

// Cerrar el modal al hacer clic fuera de él
window.onclick = function(event) {
    if (event.target == document.getElementById('deleteModal')) {
        closeModal('deleteModal');
    }
    if (event.target == document.getElementById('updateModal')) {
        closeModal('updateModal');
    }
    
}
