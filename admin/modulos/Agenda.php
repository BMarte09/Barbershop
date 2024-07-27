
<script>


function updateDate() {
    var selectedDate = document.getElementById('date-picker').value;
   // document.getElementById('selectedDate').innerText = selectedDate;

    if (selectedDate) {
        // Redirige la página con el parámetro dateFilter en la URL
        window.location.href = "?p=agenda&dateFilter=" + encodeURIComponent(selectedDate);
    }

}    

    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
    }

    // Función para cerrar el modal
    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
    }
</script>

<?php

$dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : null;
echo $dateFilter;
require_once '../configs/Database.php';

require_once '../configs/Cita.php';

$database = new Database();

$cita = new Cita($database);

$allAppointments= $cita->getAllAppointments();



if (isset($_POST['agendar'])) {
    // Limpiar y asignar variables
    $id_cliente = clear($_POST['cliente']);
    $barber = clear($_POST['barbero']);
    $date = clear($_POST['fecha']);
    $time = clear($_POST['hora']);
    $service = clear($_POST['servicio']);


    $result = $cita->createAppointment($id_cliente, $barber, $date, $time, $service);
}

/*
if ($mysqli->more_results()) {
    $mysqli->next_result();
}*/

if (isset($_GET['cancelar'])) {

    $cancelar = clear($_GET['cancelar']);

    $result = $cita->cancelAppointmentStatus($cancelar);
}

if (isset($_GET['citaId'])) {
    $modificar = clear($_GET['citaId']);  // Asegúrate de convertir el ID a un entero para evitar inyecciones SQL



    $result = $cita->updateAppointmentStatus($modificar);
}
// Obtener todas las citas filtradas por fecha




if ($dateFilter) {
    $allAppointments = $cita->getAllAppointmentsByDate($dateFilter);
} else {
    $allAppointments = $cita->getAllAppointments();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <style>
        /* Estilos básicos para la tabla */
        .agenda_container {
            flex: 1;
            /* Ocupa el espacio disponible en .content-wrapper */
            overflow-y: auto;
            /* Permite desplazamiento vertical si el contenido excede */
            padding: 1rem;
            /* Espacio interno para evitar el desbordamiento */

            box-sizing: border-box;
            /* Incluye padding en el tamaño total */
        }

        /* Estilo para la tabla */
        table {
            width: 100%;
            /* Asegura que la tabla ocupe todo el ancho del contenedor */
            border-collapse: collapse;
            /* Colapsa los bordes para evitar espacios entre ellos */
            table-layout: fixed;
            /* Ajusta el diseño de la tabla para que se ajuste al ancho del contenedor */
        }

        /* Estilo para celdas de tabla */
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            word-wrap: break-word;
            /* Asegura que el texto largo se ajuste */
        }

        /* Estilo para los encabezados de tabla */
        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        /* Estilo para la fecha seleccionada */
        .selected-date {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        /* Estilo para el input de fecha */
        .date-filter {
            margin-bottom: 20px;
        }

        /* Estilo para el mensaje de no resultados */
        .no-results {
            text-align: center;
            margin-top: 5rem;
            font-size: 1em;
            opacity: 0.8;
            color: #333;
            display: block;
            align-items: center;
            justify-content: space-around;

        }

        .fa-magnifying-glass {
            font-size: 15rem;
            color: red;
            opacity: 0.5;
            text-align: center;
            padding-top: 2rem;
        }
        .disabled-row {
          
        color: #a9a9a9; /* Color de texto gris */
        text-decoration: line-through; /* Texto tachado */
        pointer-events: none; /* Deshabilita los eventos del mouse */
    }
    .disabled-row i{
        pointer-events: none; 
        color: #a9a9a9;
    }
    </style>
</head>

<body>

    <div class="agenda_container">

        <a href="#" ; onclick="openModal('agendar-cita-modal')" class="btn btn-agenda"> Reservar cita</a>
        <div class="date-filter">
            <label for="date-picker">Seleccione una fecha: </label>
            <div class="selected-date" id="selectedDate"> </div>
            <div class="form-group">

                <input type="date" class="custom-input" id="date-picker" onchange="updateDate()">
            </div>

        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th><i class="fa-regular fa-clock agenda-icon"></i>Hora</th>
                    <!--  <th>ID Cita</th> -->

                    <th><i class="fa-solid fa-user-clock agenda-icon"></i> &nbsp;Cliente</th>
                    <th><i class="fa-solid fa-user agenda-icon"></i> &nbsp;Barbero</th>
                    <th><i class="fa-solid fa-calendar-days agenda-icon"></i>&nbsp;Fecha de la Cita</th>

                    <th><i class="fa-solid fa-scissors agenda-icon"></i> &nbsp;Servicio</th>
                    <th><i class="fa-solid fa-spinner agenda-icon"></i>&nbsp;Estado de la Cita</th>
                    <th><i class="fa-solid fa-list-check agenda-icon"></i>&nbsp;Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body">
    <?php foreach ($allAppointments as $rp) :
        $rowClass = ($rp['Estado_cita'] == 'Cancelada') ? 'disabled-row' : ''; ?>
        
        <tr data-date="<?= $rp['Fecha_cita'] ?>" class="<?= $rowClass ?>">
            <td><?= $rp['Hora_cita'] ?></td>
            <!--    <td><?= $rp['idcita'] ?></td> -->
            <td><?= $rp['nombre_cliente'] ?></td>
            <td><?= $rp['nombre_barbero'] ?></td>
            <td><?= formatearFecha($rp['Fecha_cita']) ?></td>
            <td><?= $rp['nombre_servicio'] ?></td>
            <td><?= $rp['Estado_cita'] ?></td>
            <td>
                <a href="?p=agenda&citaId=<?= $rp['idcita'] ?>"><i class="fa-solid fa-circle-check agenda-icon"></i></a>
                &nbsp;
                <a href="?p=agenda&cancelar=<?= $rp['idcita'] ?>"><i class="fa fa-times agenda-icon"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
            </tbody>
        </table>

        <div id="" class="no-results" <?php if (count($allAppointments) > 0) { echo 'style="display: none;"'; } ?>>
            <h2>No se encontraron resultados...</h2>
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>



    <div id="agendar-cita-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('agendar-cita-modal')">&times;</span>

            <form id="agendar_cita_form" class="agendar_cita_form" action="#" method="POST">
                <!-- Campos del formulario para agendar cita -->
                <h1 class="title-form">Agendar Cita</h1>


                <label class="label_input" for="cliente">Cliente</label>

                <div class="form-group">
                    <select id="cliente" class="custom-input select-custom" name="cliente" required>
                        <option class="" value="">Seleccionar el cliente</option>
                        <?php
                        $q = $mysqli->query("SELECT idCliente,Nombre, Apellido FROM clientes");

                        while ($r = mysqli_fetch_array($q)) {
                        ?>
                            <option value="<?= $r['idCliente'] ?>"><?= $r['Nombre'] . " " . $r['Apellido'] ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <label class="label_input" for="fecha">Fecha:</label>
                <div class="form-group">

                    <input type="date" class="custom-input" id="fecha" name="fecha" required>
                </div>
                <label class="label_input" for="hora">Hora:</label>

                <div class="form-group">
                    <input type="time" class="custom-input" id="hora" name="hora" required>
                </div>

                <label class="label_input" for="servicio">Servicio:</label>
                <div class="form-group">
                    <select id="servicio" class="custom-input select-custom" name="servicio" required>
                        <option class="" value="">Seleccionar servicio</option>
                        <?php
                        $q = $mysqli->query("SELECT idServicio,Nombre FROM servicios");

                        while ($r = mysqli_fetch_array($q)) {
                        ?>
                            <option value="<?= $r['idServicio'] ?>"><?= $r['Nombre'] ?></option>
                        <?php
                        }
                        ?>

                    </select>

                </div>

                <label class="label_input" for="estilista">Barbero:</label>
                <div class="form-group">
                    <select id="barbero" class="custom-input" name="barbero" required>
                        <option value="">Seleccionar estilista</option>
                        <?php
                        $q = $mysqli->query("SELECT idBarbero,Nombre, Apellido FROM barberos");

                        while ($r = mysqli_fetch_array($q)) {
                        ?>
                            <option value="<?= $r['idBarbero'] ?>"><?= $r['Nombre'] . " " . $r['Apellido'] ?></option>
                        <?php


                        }
                        $mysqli->close();
                        ?>

                    </select>
                </div>

                <button type="submit" name="agendar" ; class="btn btn-agenda">Agendar</button>
            </form>
        </div>
    </div>
</body>

</html>

