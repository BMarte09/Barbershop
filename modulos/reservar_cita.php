<script>
    // Función para abrir el modal
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

require_once 'configs/Database.php';
require_once 'configs/Service.php';
require_once 'configs/Barber.php';
require_once 'configs/Cita.php';
$database = new Database();
$service = new Service($database);
$barber = new Barber($database);



$allServices = $service->getNameAllServices();

$allBarbers = $barber->getAllBarbers();

if (isset($_POST['agendar'])) {
    // Limpiar y asignar variables
    $id_cliente = clear($_SESSION['id_cliente']);
    $barber = clear($_POST['barbero']);
    $date = clear($_POST['fecha']);
    $time = clear($_POST['hora']);
    $service = clear($_POST['servicio']);


$cita = new Cita($database);

$result = $cita->createAppointment($id_cliente,$barber,$date, $time,$service);
    /*$insertUserQuery = "CALL CrearCita('$id_cliente','$barber','$date', '$time','$service','Pendiente')";
    if (!$mysqli->query($insertUserQuery)) {
        echo "Error al insertar el usuario: " . $mysqli->error;
        die();
    }

    alert("Te has registrado satisfactoriamente.", 1, 'dashboard',0);*/
}

?>

<div id="agendar-cita-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('agendar-cita-modal')">&times;</span>

        <form id="agendar_cita_form" class="agendar_cita_form" action="#" method="POST">
            <!-- Campos del formulario para agendar cita -->
            <h2 class="title-form">Agendar Cita</h2>
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
                    <?php foreach ($allServices as $s) : ?>
                        <option value="<?= clear($s['idServicio']) ?>">
                            <?= clear($s['Nombre']) ?>
                        </option>
                    <?php endforeach; ?>

                </select>

            </div>

            <label class="label_input" for="estilista">Barbero:</label>
            <div class="form-group">
                <select id="barbero" class="custom-input" name="barbero" required>
                    <option value="">Seleccionar estilista</option>
                    <?php foreach ($allBarbers as $b) : ?>
                        <option value="<?= clear($b['idBarbero'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= clear($b['Nombre'] . " " . $b['Apellido'], ENT_QUOTES, 'UTF-8') ?>
                        </option>
                    <?php endforeach; ?>


                </select>
            </div>
            <button type="submit" name="agendar" ; class="btn btn-agenda">Agendar</button>
        </form>
    </div>
</div>