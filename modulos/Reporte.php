
















<div class="Reporte-container">


<h2 class="register_title">Reportes</h2>
<div class="titulo_grafica">
<h1 class="t_grafica"> <i class="fa-solid fa-money-bill-trend-up"></i> Consulte su rendimiento financiero aqui...</h1>
<p class="info-grafica">El informe del dia actual se muestra de forma predeterminada.</p>
            </div>
    


<div>
<label class="label_input" for="estilista">Barbero:</label>
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
<div class="board">
      
        
        <div class="sub_board">
            <div class="sep_board"></div>
            <div class="cont_board">
                <div class="graf_board">
                    <div class="barra">
                        <div class="sub_barra" style="height: 35%;">
                            <div class="tag_g">35%</div>
                            <div class="tag_leyenda">Corte de pelo</div>
                        </div>
                    </div>
                    <div class="barra">
                    <div class="sub_barra" style="height: 45%;">
                            <div class="tag_g">45%</div>
                            <div class="tag_leyenda">Corte de barba</div>
                        </div>
                    </div>
                    <div class="barra">
                    <div class="sub_barra" style="height: 55%;">
                            <div class="tag_g">55%</div>
                            <div class="tag_leyenda">Corte de pelo y barba</div>
                        </div>
                    </div>
                    <div class="barra">
                    <div class="sub_barra" style="height: 75%;">
                            <div class="tag_g">75%</div>
                            <div class="tag_leyenda">Cerquillo</div>
                        </div>
                    </div>
                  
                </div>
                <div class="tag_board">
                    <div class="sub_tag_board">
                        <div>100</div>
                        <div>90</div>
                        <div>80</div>
                        <div>70</div>
                        <div>60</div>
                        <div>50</div>
                        <div>40</div>
                        <div>30</div>
                        <div>20</div>
                        <div>10</div>
                    </div>
                </div>
           </div> 
            <div class="sep_board"></div>
       </div>    
    </div>

<div class="total-income">
    <i class="fa-solid fa-angle-left" onclick="changeDate(-1)"></i>
<div class="content">
  <div>
    <img src="resources/images/ingresos_icon.png" class="income_icon" alt="Income Icon">
    </div>
    <div>
        <div id="current-date" class="current-date"></div>
        <div id="total-income-amount" class="total-income-amount">Ingresos: $0</div>
    </div>
    </div>


    <i class="fa-solid fa-chevron-right" onclick="changeDate(1)"></i>
</div>
</div>

    <script>
     const totalIncomeAmount = 100; // Example amount, you can dynamically calculate this
    document.getElementById('total-income-amount').innerText = `Ingresos:       $${totalIncomeAmount}`;

    const monthNames = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
    const dayNames = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
    
    let currentDate = new Date();

    function updateDateDisplay() {
        const day = dayNames[currentDate.getDay()];
        const date = currentDate.getDate();
        const month = monthNames[currentDate.getMonth()];
        const year = currentDate.getFullYear();
        document.getElementById('current-date').innerText = `${day} ${date} de ${month} del ${year}`;
    }

    function changeDate(days) {
        currentDate.setDate(currentDate.getDate() + days);
        updateDateDisplay();
    }

    // Initialize the date display
    updateDateDisplay();
</script>





























<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gráfico de Barras Vertical con CSS</title>
<style>
    .chart {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        width: 400px;
        height: 300px;
        border: 1px solid #ccc;
        margin: 20px auto;
        padding: 20px;
        background-color: #f5f5f5;
        position: relative; /* Para posicionar las etiquetas */
        
    }
    
    .bar {
        width: 50px; /* Ancho de cada barra */
        background-color: #3498db; /* Color de las barras */
        margin: 0 10px; /* Espacio entre barras */
      
        transition: height 0.5s ease, background-color 0.3s; /* Transiciones suaves */
        position: relative;
    }
    .bar:hover {
        background-color: #2980b9; /* Color al hacer hover */
    }
    .bar-label {
        text-align: center;
        margin-top: 5px;
    }
</style>
</head>
<body>
<div class="reporte-container">

<h1></h1>
<div class="chart">
    <div class="bar" ></div>
    <div class="bar" style="height: 30%;"></div>
    <div class="bar" style="height: 80%;"></div>
    <div class="bar" style="height: 45%;"></div>
</div>

<div class="bar-labels">
    <div class="bar-label">Servicio A</div>
    <div class="bar-label">Servicio B</div>
    <div class="bar-label">Servicio C</div>
    <div class="bar-label">Servicio D</div>
</div>
</div>
</body>
</html>
-->