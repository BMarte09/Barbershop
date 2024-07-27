<?php
$dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <style>
        /* Estilos básicos para la tabla */
        table {
            width: 80%;
            border-collapse: collapse;
        }

        .selected-date {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilos para el input de fecha */
        .date-filter {
            margin-bottom: 20px;
        }

        /* Estilo para el mensaje de no resultados */
        .no-results {
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
            color: red;
        }
    </style>
</head>
<body>
    <div class="date-filter">
        <label for="date-picker">Seleccione una fecha: </label>
        <input type="date" id="date-picker" onchange="updateDate()">
        <div class="selected-date" id="selectedDate"> </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                 <th>Hora</th>
                <th>ID Cita</th>
                
                <th>Cliente</th>
                <th>Barbero</th>
                <th>Fecha de la Cita</th>
             
                <th>Servicio</th>
                <th>Estado de la Cita</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php
         

            // Consulta para obtener todas las citas
            $result = $mysqli->query("SELECT * FROM vista_citas_detalladas ORDER BY idcita DESC");
            while($rp = mysqli_fetch_array($result)){
                ?>
                <tr data-date="<?=$rp['Fecha_cita']?>">
                    <td><?=$rp['idcita']?></td>
                    <td><?=$rp['nombre_cliente']?> <?=$rp['apellido_cliente']?></td>
                    <td><?=$rp['nombre_barbero']?> <?=$rp['apellido_barbero']?></td>
                    <td><?=formatearFecha($rp['Fecha_cita'])?></td>
                    <td><?=$rp['Hora_cita']?></td>
                    <td><?=$rp['nombre_servicio']?></td>
                    <td><?=$rp['Estado_cita']?></td>
                    <td>
                        <a href="?p=modificar_cita&id=<?=$rp['idcita']?>"><i class="fa-solid fa-circle-check"></i></a>
                        &nbsp;
                        <a href="?p=eliminar_cita&id=<?=$rp['idcita']?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php
            }

            // Cerrar la conexión
            $mysqli->close();
            ?>
        </tbody>
    </table>

    <div id="no-results" class="no-results" style="display: none;">No se encontraron resultados</div>

    <script>
        document.getElementById('date-picker').addEventListener('change', function() {
            var selectedDate = this.value;
            var tableRows = document.querySelectorAll('#table-body tr');
            var noResults = true;
            

            tableRows.forEach(function(row) {
                var rowDate = row.getAttribute('data-date');
                if (rowDate === selectedDate) {
                    row.style.display = '';
                    noResults = false;
                } else {
                    row.style.display = 'none';
                }
            });

            if (noResults) {
                document.getElementById('no-results').style.display = 'block';
            } else {
                document.getElementById('no-results').style.display = 'none';
            }

            if( selectedDate){
                var Currentdate = new Date(dateFilter);
            }
        });

        function updateDate() {
            var dateFilter = document.getElementById('date-picker').value;
            var selectedDateDiv = document.getElementById('selectedDate');
            selectedDateDiv.textContent = dateFilter ? `Fecha seleccionada: ${dateFilter}` : 'Selecciona una fecha';
            document.getElementById('filterForm').submit();
        }
    </script>
</body>
</html>
