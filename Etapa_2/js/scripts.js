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

// Eliminar la tarea si se confirma
function deleteTask() {
    if (deleteId) {
        window.location.href = 'delete.php?id=' + deleteId;
    }
}let taskToDelete;

function confirmDelete(id) {
    taskToDelete = id; // Guardar el ID de la tarea a eliminar
    document.getElementById('deleteModal').style.display = 'block'; // Mostrar el modal de eliminación
}

function deleteTask() {
    // Redirigir a delete.php con el ID de la tarea para eliminar
    window.location.href = 'delete.php?id=' + taskToDelete;
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

