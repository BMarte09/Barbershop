<?php
require_once '../configs/Database.php';

require_once '../configs/Cita.php';
require_once '../configs/Service.php';

$database = new Database();

$cita = new Cita($database);
$service = new Service($database);

$Programadas = $cita->getAppointmentsCountToday();
$Atendidas = $cita->getAttendedAppointmentsCountToday();
$Canceladas = $cita->getCanceledAppointmentsCountToday();
$TotalIncomeDay = $service->getTotalDailyIncome();


$ingresosMensuales = $service->getMonthlyIncome($database);

// Convertir los resultados a JSON
$labels = array_keys($ingresosMensuales);
$data = array_values($ingresosMensuales);

$labels_json = json_encode($labels);
$data_json = json_encode($data);

// Depuración
/*
file_put_contents('debug.log', print_r($labels, true));
file_put_contents('debug.log', print_r($data, true), FILE_APPEND);*/
?>
<!-- CONTENT -->
<section id="content">


	<!-- MAIN -->
	<main>
		<div class="head-title">
			<div class="left">
				<h1>Admin Dashboard</h1>
				<ul class="breadcrumb">
					<li>
						<a href="#">Dashboard</a>
					</li>
					<li><i class='bx bx-chevron-right'></i></li>
					<li>
						<a class="active" href="#">Home</a>
					</li>
				</ul>
			</div>

		</div>

		<ul class="box-info">
			<li>
				<i class='bx bxs-calendar-check'></i>
				<span class="text">
					<h3><?php echo $Programadas ?></h3>
					<p>Citas programadas</p>
				</span>
			</li>
			<li>
				<i class='bx bxs-group'></i>
				<span class="text">
					<h3><?php echo $Atendidas ?></h3>
					<p>Citas atendidas</p>
				</span>
			</li>
			<li>
				<i class='bx bxs-dollar-circle'></i>
				<span class="text">
					<h3><?php echo $TotalIncomeDay ?></h3>
					<p>Total Ingresos</p>
				</span>
			</li>
		</ul>


		<div class="chart-container">
			<div class="chart2 chart">
				<div class="head">
					<h3>Citas del dia de hoy</h3>
					<i class='bx bx-search'></i>
					<i class='bx bx-filter'></i>
				</div>
				<div class="chart_content">
					<canvas id="pie-chart" width="300" height="400"></canvas>
				</div>
			</div>


			<div class="chart1 chart">
				<div class="head">
					<div>
						<h3>Todos</h3>
						<i class='bx bx-plus'></i>
						<i class='bx bx-filter'></i>
					</div>

					<!-- Select BARBERO-->


					<div class="form-group">
						<select id="estilista" class="custom-input" name="estilista" required>
							<option value="">Seleccionar el barbero</option>
							<option value="juan">Juan</option>
							<option value="maria">Maria</option>
							<option value="carlos">Carlos</option>
							<option value="carlos">Todos los barberos</option>
						</select>
					</div>


				</div>
				<div class="chart_content">
					<canvas id="bar-chart" width="300" height="400"></canvas>
				</div>
			</div>

			<div class="chart3 chart">
				<div class="head">
					<h3>Ingresos mensuales</h3>
					<i class='bx bx-plus'></i>
					<i class='bx bx-filter'></i>
				</div>
				<div class="chart_content">
					<canvas id="line-chart" width="800" height="400"></canvas>
				</div>
			</div>
			<div class="chart4 chart">
				<div class="head">
					<h3>Todos</h3>
					<i class='bx bx-plus'></i>
					<i class='bx bx-filter'></i>
				</div>

			</div>
		</div>
	</main>
	<!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Datos de ejemplo para los gráficos
		var lineData = {
			labels: <?php echo $labels_json; ?>,
			datasets: [{
				label: 'Ingresos totales',
				borderColor: '#e74c3c',
				backgroundColor: 'rgba(52, 152, 219, 0.2)',
				data:<?php echo $data_json; ?>
			}]
		};

		var barData = {
			labels: ['Corte de pelo', 'Corte de pelo y barba', 'Corte de barba', 'Cerquillo'],
			datasets: [{
				label: 'Cantidad vendida',
				backgroundColor: ['#efa7a7', '#d3d3d3', '#b23a48', '#e74c3c'],
				data: [4, 5, 1, 7]
			}]
		};
		
		var pieData = {
			labels: ['Citas programadas', 'Citas canceladas'],
			datasets: [{
				backgroundColor: ['#efa7a7', '#b23a48'],
				data: ['<?php echo $Programadas; ?>', '<?php echo $Canceladas; ?>']
			}]
		};

		// Configuración de los gráficos  ,'#d3d3d3'
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
			type: 'doughnut',
			data: pieData,
			options: pieChartOptions
		});
	});
</script>
</body>

</html>