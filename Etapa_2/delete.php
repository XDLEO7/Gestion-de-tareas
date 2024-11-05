<?php
session_start();
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID de la tarea a eliminar
    parse_str(file_get_contents("php://input"), $data);
    $id = $data['id'];

    // Eliminar la tarea de la base de datos
    $sql = "DELETE FROM tareas WHERE id_tarea = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Tarea eliminada exitosamente.";
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}

$conn->close();
?>
