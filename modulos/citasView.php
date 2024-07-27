<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
   <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    margin: auto;
    overflow: hidden;
}

h1 {
    text-align: center;
    margin: 20px 0;
    color: #333;
}

.card-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.2s;
    width: 300px;
}

.card:hover {
    transform: scale(1.05);
}

.card-content {
    padding: 20px;
    text-align: center;
}

.card-title {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #333;
}

.card-details {
    font-size: 1em;
    color: #777;
}

.card-actions {
    margin-top: 20px;
}

.card-actions button {
    background: #007BFF;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

.card-actions button:hover {
    background: #0056b3;
}

   </style>
</head>

<body>
    <div class="container">
        <h1>Tus Citas</h1>
        <div class="card-grid" id="citas-container">
            <!-- Las tarjetas de las citas se agregarán aquí dinámicamente -->
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const citas = [
        { id: 1, barber: 'Carlos', date: '2024-07-25', time: '10:00 AM', service: 'Corte de Cabello' },
        { id: 2, barber: 'Miguel', date: '2024-07-26', time: '11:00 AM', service: 'Afeitado' },
        { id: 3, barber: 'Luis', date: '2024-07-27', time: '12:00 PM', service: 'Corte y Tinte' },
    ];

    const container = document.getElementById('citas-container');

    citas.forEach(cita => {
        const card = document.createElement('div');
        card.classList.add('card');

        card.innerHTML = `
            <div class="card-content">
                <h2 class="card-title">Cita con ${cita.barber}</h2>
                <p class="card-details">${cita.date} a las ${cita.time}</p>
                <p class="card-details">Servicio: ${cita.service}</p>
                <div class="card-actions">
                    <button onclick="reprogramarCita(${cita.id})">Confirmar</button>
                    <button onclick="cancelarCita(${cita.id})">Cancelar</button>
                </div>
            </div>
        `;

        container.appendChild(card);
    });
});

function reprogramarCita(id) {
    alert(`Reprogramar cita con ID: ${id}`);
}

function cancelarCita(id) {
    alert(`Cancelar cita con ID: ${id}`);
}

</script>