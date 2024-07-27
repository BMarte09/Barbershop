<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'reservar_cita.php';

require_once 'configs/Database.php';

require_once 'configs/Cita.php';

$id_cliente = clear($_SESSION['id_cliente']);
echo $id_cliente;

$database = new Database();

$cita = new Cita($database);

$pendingAppointments = $cita->getPendingAppointments($id_cliente);
//echo '<pre>' . htmlspecialchars(json_encode($pendingAppointments, JSON_PRETTY_PRINT)) . '</pre>';//

    $notificationsHtml = '';

    if (!empty($pendingAppointments)) {
        foreach ($pendingAppointments as $appointment) {
            $fechaCita = formatearFecha($appointment['Fecha_cita']); // Usar la función para formatear la fecha
            $horaCita = date('h:i A', strtotime($appointment['Hora_cita'])); // Formato de hora
            
            $notificationsHtml .= '<li>';
            $notificationsHtml .= '    <div class="notification-item">';
            $notificationsHtml .= '        <div class="notification-info">';
            $notificationsHtml .= '            <p class="notification-date">Fecha: ' . clear($fechaCita) . '</p> &nbsp; &nbsp;';
            $notificationsHtml .= '            <p class="notification-time">Hora: ' . clear($horaCita) . '</p>';
            $notificationsHtml .= '        </div>';
            $notificationsHtml .= '        <div class="notification-message">';
            $notificationsHtml .= '            <div>';
            $notificationsHtml .= '                <p>Hola, no olvides tu cita de corte de pelo en tu barbería preferida!</p>';
            $notificationsHtml .= '                <div class="notification-action">';
            $notificationsHtml .= '                    <button class="btn confirm-button">Confirmar cita</button>';
            $notificationsHtml .= '                </div>';
            $notificationsHtml .= '            </div>';
            $notificationsHtml .= '            <img src="resources/images/corte-img.png" class="notifaction-img" alt="Barbería">';
            $notificationsHtml .= '        </div>';
            $notificationsHtml .= '    </div>';
            $notificationsHtml .= '</li>';
        }
    } else {
        $notificationsHtml = '<li><p>No tienes citas pendientes para confirmar en los próximos días.</p></li>';
    } 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Aquí puedes incluir CSS y otros archivos -->
</head>
<body>

<div id="dashboard" class="dashboard">
    <div class="dashboard-grid">
        <a href="#" class="dashboard-card" onclick="openModal('agendar-cita-modal')">
            <img src="resources/images/reservar_cita.png" class="img-card" alt="Imagen">
            <span>RESERVAR CITAS</span>
        </a>

        <a href="#" class="dashboard-card" onclick="openModal('notificationModal')">
            <img src="resources/images/agenda.png" class="img-card" alt="Imagen">
            <span>CITAS AGENDADAS</span>
        </a>
    </div>
    <div class="dashboard-logo">
        <img src="resources\images\Barberia_background.png" alt="login form" class="login_icon" />
    </div>
</div>



<div id="notificationModal" class="modalNotify">
    <div class="modal-content-notify">
        <span class="close" onclick="closeModal('notificationModal')">×</span>
        <h2>Notificaciones</h2>
        <ul id="notificationList">

        <?php echo $notificationsHtml; ?>
         <!--   <li>
                <div class="notification-item">
                    <div class="notification-info">
                        <p class="notification-date">Fecha: 10 de julio de 2024</p> &nbsp; &nbsp;
                        <p class="notification-time">Hora: 10:00 AM</p>
                    </div>
                    <div class="notification-message">
                        <div>
                            <p>Hola, no olvides tu cita de corte de pelo en tu barbería preferida!</p>
                            <div class="notification-action">
                                <button class="btn confirm-button">Confirmar cita</button>
                            </div>
                        </div>
                        <img src="resources/images/corte-img.png" class="notifaction-img" alt="Barbería">
                    </div>

                </div>
            </li>
            <li>
                <div class="notification-item">
                    <div class="notification-info">
                        <p class="notification-date">Fecha: 10 de julio de 2024</p> &nbsp; &nbsp;
                        <p class="notification-time">Hora: 10:00 AM</p>
                    </div>
                    <div class="notification-message">
                        <div>
                            <p>Hola, no olvides tu cita de corte de pelo en tu barbería preferida!</p>
                            <div class="notification-action">
                                <button class="btn confirm-button">Confirmar cita</button>
                            </div>
                        </div>
                        <img src="resources/images/corte-img.png" class="notifaction-img" alt="Barbería">
                    </div>

                </div>
            </li> -->
            <!-- Puedes agregar más notificaciones de esta manera -->
        </ul>
    </div>
</div>
</body>
</html>