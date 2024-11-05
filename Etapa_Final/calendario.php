<?php  
session_start();
include("conexion.php");

// Obtiene las tareas para el calendario
$sql = "SELECT id_tarea, titulo_tarea, fecha_inicio, fecha_vencimiento 
        FROM tareas";
$result = $conn->query($sql);
$tareas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tareas[] = [
            'id' => $row['id_tarea'],
            'title' => $row['titulo_tarea'],
            'start' => $row['fecha_inicio'],
            'end' => $row['fecha_vencimiento']
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <link rel="stylesheet" href="css/calendario.css">
    <title>Calendario de Tareas</title>
</head>
<body>

<div class="topnav">
    <a href="calendario.php">Inicio</a>
    <a href="index.php">Administrar tareas</a>
    <a href="ayuda.php">Ayuda</a>
    <a href="documentacion.php">Documentación</a>
</div>

<h1>Calendario de Tareas</h1>

<div id='calendar'></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tareas = <?php echo json_encode($tareas); ?>;

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: tareas
        });

        calendar.render();
    });
</script>

</body>
</html>

