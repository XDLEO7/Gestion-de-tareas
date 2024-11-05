<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda</title>
    <link rel="stylesheet" href="css/ayuda.css"> 
</head>
<body>
    <div class="topnav">
        <a href="calendario.php">Inicio</a>
        <a href="index.php">Administrar tareas</a>
        <a href="ayuda.php">Ayuda</a>
        <a href="documentacion.php">Documentación</a>
    </div>

    <div class="content">
        <h1>Instrucciones de Uso del Proyecto Web de Gestión de Tareas</h1>
        
        <h2>Descripción General</h2>
        <p>Este proyecto web permite gestionar tareas de manera eficiente, proporcionando funcionalidades para crear, visualizar, actualizar y eliminar tareas. También incluye un calendario que permite visualizar las tareas de una manera más organizada y accesible.</p>

        <h2>Requisitos Previos</h2>
        <ul>
            <li>Servidor web compatible con PHP (por ejemplo, XAMPP).</li>
            <li>Base de datos MySQL configurada con el nombre <strong>tareasDB</strong>.</li>
            <li>Tabla <strong>tareas</strong> con los campos adecuados:
                <ul>
                    <li><strong>id_tarea</strong> (INT, AUTO_INCREMENT, PRIMARY KEY)</li>
                    <li><strong>titulo_tarea</strong> (VARCHAR)</li>
                    <li><strong>fecha_inicio</strong> (DATE)</li>
                    <li><strong>fecha_vencimiento</strong> (DATE)</li>
                    <li><strong>id_categoria</strong> (INT, FOREIGN KEY)</li>
                    <li><strong>tarea_completada</strong> (TINYINT)</li>
                    <li><strong>descripcion_tarea</strong> (TEXT)</li>
                </ul>
            </li>
            <li>Tabla <strong>categorias</strong> para la gestión de categorías de tareas.</li>
        </ul>

        <h2>Archivos del Proyecto</h2>
        <ol>
            <li><strong>conexion.php:</strong> Este archivo establece la conexión con la base de datos. Modifica las variables según sea necesario para que coincidan con tu configuración:
                <pre>
$servername = "localhost";  // Cambia esto si es necesario
$username = "root";          // Reemplaza con tu nombre de usuario
$password = "";              // Reemplaza con tu contraseña
$dbname = "tareasDB";       // Reemplaza con el nombre de tu base de datos
                </pre>
            </li>
            <li><strong>index.php:</strong> Esta es la página principal donde se listan las tareas. Contiene funcionalidades para:
                <ul>
                    <li>Ver la lista de tareas.</li>
                    <li>Crear nuevas tareas.</li>
                    <li>Editar tareas existentes.</li>
                    <li>Eliminar tareas.</li>
                </ul>
                También muestra un mensaje de notificación después de realizar una acción.
            </li>
            <li><strong>insert.php:</strong> Permite agregar nuevas tareas a la base de datos. Completa el formulario con los detalles de la tarea y haz clic en "Añadir Tarea" para guardarla.</li>
            <li><strong>update.php:</strong> Esta página permite actualizar tareas existentes. Selecciona la tarea que deseas editar y modifica los detalles necesarios. Después de realizar los cambios, guarda la tarea actualizada.</li>
            <li><strong>delete.php:</strong> Este archivo se encarga de eliminar tareas de la base de datos. La eliminación se realiza mediante una solicitud AJAX, lo que permite que la página se actualice sin recargar.</li>
            <li><strong>documentacion.php:</strong> Este archivo proporciona documentación detallada sobre el uso del sistema, incluyendo instrucciones sobre cómo utilizar las diferentes funcionalidades y ejemplos de uso. Los usuarios pueden consultar este archivo para obtener más información sobre cómo gestionar sus tareas de manera efectiva.</li>
            <li><strong>Calendario:</strong> El calendario se ha integrado en el proyecto para ofrecer una visualización más clara de las tareas. Al hacer clic en una fecha específica, se mostrarán las tareas asociadas a esa fecha, facilitando su gestión.</li>
        </ol>

        <h2>Funcionalidades Clave</h2>
        <ul>
            <li><strong>Gestión de Tareas:</strong> Crear, editar y eliminar tareas.</li>
            <li><strong>Visualización de Tareas:</strong> Listado de tareas con detalles relevantes.</li>
            <li><strong>Notificaciones:</strong> Mensajes de éxito o error tras las acciones realizadas.</li>
            <li><strong>Calendario:</strong> Visualiza las tareas programadas de manera organizada, facilitando su seguimiento.</li>
        </ul>

        <h2>Uso</h2>
        <ol>
            <li><strong>Conexión a la Base de Datos:</strong> Asegúrate de que conexion.php está configurado correctamente.</li>
            <li><strong>Navegación:</strong> Usa el menú de navegación para acceder a las diferentes secciones del proyecto (Inicio, Ayuda).</li>
            <li><strong>Agregar Tareas:</strong> Haz clic en "Crear Nueva Tarea" y completa el formulario.</li>
            <li><strong>Editar Tareas:</strong> Selecciona "Editar" en la tarea que deseas modificar.</li>
            <li><strong>Eliminar Tareas:</strong> Haz clic en "Eliminar" y confirma la acción en la ventana emergente.</li>
            <li><strong>Ver Tareas en el Calendario:</strong> Haz clic en la fecha deseada en el calendario para ver las tareas asociadas.</li>
            <li><strong>Consultar Documentación:</strong> Accede a documentacion.php para obtener más detalles sobre el uso del sistema.</li>
        </ol>
    </div>
</body>
</html>
