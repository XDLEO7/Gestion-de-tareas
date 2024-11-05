<?php 
    include("conexion.php"); // Archivo de conexión

    // Consulta SQL para obtener las tareas
    $sql = "SELECT tareas.titulo_tarea, tareas.fecha_inicio, tareas.fecha_vencimiento, categorias.nombre_categoria, tareas.tarea_completada, tareas.descripcion_tarea 
            FROM tareas 
            JOIN categorias ON tareas.id_categoria = categorias.id_categoria";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .completed {
            color: green;
            font-weight: bold;
        }
        .not-completed {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Lista de Tareas</h1>

    <?php
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Título</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Vencimiento</th>
                <th>Categoría</th>
                <th>Completada</th>
                <th>Descripción</th>
              </tr>";

        // Mostrar los resultados en una tabla
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["titulo_tarea"] . "</td>";
            echo "<td>" . $row["fecha_inicio"] . "</td>";
            echo "<td>" . $row["fecha_vencimiento"] . "</td>";
            echo "<td>" . $row["nombre_categoria"] . "</td>";
            echo "<td class='" . ($row["tarea_completada"] ? 'completed' : 'not-completed') . "'>" 
                . ($row["tarea_completada"] ? 'Sí' : 'No') . "</td>";
            echo "<td>" . $row["descripcion_tarea"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron tareas.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>

</body>
</html>
