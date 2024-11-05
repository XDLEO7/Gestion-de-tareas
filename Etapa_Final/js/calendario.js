document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['dayGrid', 'timeGrid', 'list'],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        themeSystem: 'bootstrap', // Usar el tema de Bootstrap
        events: [],
        aspectRatio: 2
    });

    calendar.render();
    obtenerTareasParaCalendario(calendar);
});

async function obtenerTareasParaCalendario(calendar) {
    const userId = localStorage.getItem('userId');
    if (!userId) return;

    const estudiante = { id_estudiante: userId };
    try {
        const response = await fetch('http://localhost:8080/tareasdb', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(estudiante)
        });

        if (!response.ok) {
            throw new Error('Error al obtener las tareas');
        }

        const tareas = await response.json();
        tareas.forEach(tarea => {
            calendar.addEvent({
                title: tarea.titulo,
                start: tarea.fechaFin,
                allDay: true
            });
        });
        calendar.render();
    } catch (error) {
        console.error('Error al cargar tareas en el calendario:', error);
    }
}

