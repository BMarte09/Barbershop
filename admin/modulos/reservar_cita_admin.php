<?php

if (isset($_POST['agendar'])) {
    // Limpiar y asignar variables
    $id_cliente = clear($_POST['cliente']);
    $barber = clear($_POST['barbero']);
    $date = clear($_POST['fecha']);
    $time = clear($_POST['hora']);
    $service = clear($_POST['servicio']);

    $insertUserQuery = "CALL CrearCita('$id_cliente','$barber','$date', '$time','$service','Pendiente')";
    if (!$mysqli->query($insertUserQuery)) {
        echo "Error al insertar el usuario: " . $mysqli->error;
        die();
    }

    alert("Te has registrado satisfactoriamente.", 1, 'modulos/Agenda.php', 1);
}

?>

<