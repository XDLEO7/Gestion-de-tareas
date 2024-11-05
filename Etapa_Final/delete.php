<?php
session_start();
include("conexion.php");

// Verificar que la solicitud sea de tipo DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Leer los datos del cuerpo de la solicitud para obtener el ID de la tarea
    parse_str(file_get_contents("php://input"), $data);
    $id = isset($data['id']) ? intval($data['id']) : 0;

    // Verificar que se haya proporcionado un ID válido
    if ($id > 0) {
        // Preparar la consulta SQL para eliminar la tarea
        $sql = "DELETE FROM tareas WHERE id_tarea = $id";

        // Ejecutar la consulta y verificar si se eliminó correctamente
        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Tarea eliminada exitosamente.";
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $conn->error]); // Enviar el error si ocurre
        }
    } else {
        // Respuesta de error si el ID no es válido
        echo json_encode(["success" => false, "error" => "ID de tarea no válido"]);
    }
} else {
    // Respuesta de error si el método no es DELETE
    echo json_encode(["success" => false, "error" => "Método de solicitud no permitido"]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
