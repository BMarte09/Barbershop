<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    .chart-container {
        margin-bottom: 30px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Dashboard de Reportes</h2>

    <div class="chart-container">
        <canvas id="line-chart" width="800" height="400"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="bar-chart" width="800" height="400"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="pie-chart" width="800" height="400"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Datos de ejemplo para los gráficos
        var lineData = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Julio'],
            datasets: [{
                label: 'Ventas',
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                data: [250, 400, 200, 300, 500]
            }]
        };

        var barData = {
            labels: ['Producto A', 'Producto B', 'Producto C', 'Producto D'],
            datasets: [{
                label: 'Cantidad vendida',
                backgroundColor: ['#2ecc71', '#3498db', '#e74c3c', '#f39c12'],
                data: [50, 120, 80, 200]
            }]
        };

        var pieData = {
            labels: ['Categoría A', 'Categoría B', 'Categoría C'],
            datasets: [{
                backgroundColor: ['#2ecc71', '#3498db', '#e74c3c'],
                data: [30, 50, 20]
            }]
        };

        // Configuración de los gráficos
        var lineChartOptions = {
            responsive: true,
            maintainAspectRatio: false
        };

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        var pieChartOptions = {
            responsive: true,
            maintainAspectRatio: false
        };

        // Crear los gráficos
        var lineChart = new Chart(document.getElementById('line-chart'), {
            type: 'line',
            data: lineData,
            options: lineChartOptions
        });

        var barChart = new Chart(document.getElementById('bar-chart'), {
            type: 'bar',
            data: barData,
            options: barChartOptions
        });

        var pieChart = new Chart(document.getElementById('pie-chart'), {
            type: 'pie',
            data: pieData,
            options: pieChartOptions
        });
    });
</script>

</body>
</html>

