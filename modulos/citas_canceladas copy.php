<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard de Reportes</title>
<style>
    body, .container {
        max-width: 1200px; /* Ancho máximo para el contenido */
        margin: 0 auto; /* Centrar el contenido en la página */
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .chart-container {
        text-align: center;
        margin-bottom: 50px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 20px;
        overflow: hidden;
    }

    canvas {
        max-width: 20%;
        height: 200px;
    }

    .control-panel {
        margin-top: 20px;
        text-align: center;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        margin: 0 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="control-panel">
    <button onclick="updateChart('day')">Ver Citas Canceladas del Día</button>
    <button onclick="updateChart('month')">Ver Citas Canceladas del Mes</button>
</div>

<div class="chart-container">
    <h3>Proporción de Citas Canceladas</h3>
    <canvas id="cancelledAppointmentsChart"></canvas>
</div>

<div class="chart-container">
    <h3>Número de Citas por Barbero</h3>
    <canvas id="appointmentsByBarberChart"></canvas>
</div>

<div class="chart-container">
    <h3>Ingresos Mensuales</h3>
    <canvas id="monthlyIncomeChart"></canvas>
</div>

<script>
    // Datos de prueba para los gráficos
    var cancelledAppointmentsData = {
        labels: ["Canceladas", "Atendidas"],
        datasets: [{
            data: [20, 80], // Ejemplo de datos: 20% canceladas, 80% atendidas
            backgroundColor: ['#ff6384', '#36a2eb'],
            hoverBackgroundColor: ['#ff6384', '#36a2eb']
        }]
    };

    var appointmentsByBarberData = {
        labels: ["Barbero 1", "Barbero 2", "Barbero 3", "Barbero 4"],
        datasets: [{
            label: "Número de Citas",
            backgroundColor: "#ffcc80",
            data: [10, 15, 8, 12] // Ejemplo de datos: número de citas por barbero
        }]
    };

    var monthlyIncomeData = {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
        datasets: [{
            label: "Ingresos ($)",
            borderColor: "#4caf50",
            fill: false,
            data: [1000, 1200, 900, 1500, 1800, 2000] // Ejemplo de ingresos mensuales
        }]
    };

    // Configuración de los gráficos
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:false
                }
            }]
        }
    };

    // Crear gráficos
    var ctxCancelled = document.getElementById("cancelledAppointmentsChart").getContext("2d");
    var cancelledAppointmentsChart = new Chart(ctxCancelled, {
        type: 'pie',
        data: cancelledAppointmentsData,
        options: chartOptions
    });

    var ctxAppointmentsByBarber = document.getElementById("appointmentsByBarberChart").getContext("2d");
    var appointmentsByBarberChart = new Chart(ctxAppointmentsByBarber, {
        type: 'bar',
        data: appointmentsByBarberData,
        options: chartOptions
    });

    var ctxMonthlyIncome = document.getElementById("monthlyIncomeChart").getContext("2d");
    var monthlyIncomeChart = new Chart(ctxMonthlyIncome, {
        type: 'line',
        data: monthlyIncomeData,
        options: chartOptions
    });

    // Función para actualizar los datos del gráfico de citas canceladas según la opción seleccionada
    function updateChart(option) {
        // Aquí podrías implementar la lógica para actualizar los datos según el día o mes seleccionado
        // Por ahora, sólo un ejemplo estático
        if (option === 'day') {
            cancelledAppointmentsChart.data.datasets[0].data = [30, 70]; // Ejemplo de datos para un día
        } else if (option === 'month') {
            cancelledAppointmentsChart.data.datasets[0].data = [25, 75]; // Ejemplo de datos para un mes
        }
        cancelledAppointmentsChart.update();
    }
</script>

</body>
</html>

