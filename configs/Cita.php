<?php
require_once 'Database.php';
require_once 'funciones.php';
class Cita {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->mysqli; // Usar la conexión mysqli de la instancia de Database
    }

       // Crear una nueva cita
       public function createAppointment( $id_cliente, $barber, $date, $time, $service, $status = 'Pendiente') {
        $id_cliente = clear($id_cliente);
        $barber = clear($barber);
        $date =clear($date);
        $time =clear($time);
        $service =clear($service);
        $status =clear($status);

        $query = "CALL CrearCita('$id_cliente', '$barber', '$date', '$time', '$service', '$status')";
        if ($this->db->query($query)) {
            alert("Cita creada con éxito", 1, 'dashboard',0);
            return;
        } else {
            echo "Error al crear la cita:" . $this->db->error;
            die();
            return;
        }
    }

    public function getAppointmentsByCustomer($id_cliente) {
        $id_cliente =clear($id_cliente);
        $appointments = [];
        $query = "SELECT * FROM vista_citas_detalladas WHERE idCliente = '$id_cliente' ORDER BY idcita DESC";
        $result = $this->db->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
            $result->free(); // Liberar el resultado
        } else {
            echo "Error en la consulta: " . $this->db->error;
        }

        return $appointments;
    }

    public function getAllAppointments() {
     
        $appointments = [];
        $query = "SELECT * FROM vista_citas_detalladas";
        $result = $this->db->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
            $result->free(); // Liberar el resultado
        } else {
            echo "Error en la consulta: " . $this->db->error;
        }

        return $appointments;
    }

    public function getAllAppointmentsByDate($date) {
        $date = clear($date);
        $appointments = [];
        $query = "SELECT * FROM vista_citas_detalladas WHERE '$date'= Fecha_cita";
        $result = $this->db->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $appointments[] = $row;
            }
            $result->free(); // Liberar el resultado
        } else {
            echo "Error en la consulta: " . $this->db->error;
        }

        return $appointments;
    }

    public function getPendingAppointments($userId) {
        // Calcular la fecha límite (3 días a partir de hoy)
        $dateLimit = date('Y-m-d'); // Hoy
        $endDate = date('Y-m-d', strtotime('+3 days'));

        // Consulta para obtener citas pendientes a 3 días desde la vista
        $query = "
            SELECT *
            FROM vista_citas_detalladas
            WHERE idCliente = '$userId' AND Estado_cita = 'Pendiente'
              AND Fecha_cita BETWEEN '$dateLimit' AND '$endDate'
        ";

        // Ejecutar la consulta
        $result = $this->db->query($query);

        if (!$result) {
            // Manejo de errores
            echo "Error en la consulta: " . $this->db->error;
            return [];
        }

        // Obtener resultados
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }

        return $appointments;
    }


    public function getAppointmentsCountToday() {
        // Obtener la fecha actual
        $today = date('Y-m-d');

        // Consulta para contar las citas pendientes del día actual
        $query = "
            SELECT COUNT(*) AS count
            FROM vista_citas_detalladas
            WHERE Fecha_cita = '$today'
        ";

        // Ejecutar la consulta
        $result = $this->db->query($query);

        if (!$result) {
            // Manejo de errores
            echo "Error en la consulta: " . $this->db->error;
            return 0;
        }

        // Obtener el resultado
        $row = $result->fetch_assoc();
        return (int)$row['count'];
    }

    public function getAttendedAppointmentsCountToday() {
        // Obtener la fecha actual
        $today = date('Y-m-d');

        // Consulta para contar las citas atendidas del día actual
        $query = "
            SELECT COUNT(*) AS count
            FROM vista_citas_detalladas
            WHERE Estado_cita = 'Realizada'
              AND Fecha_cita = '$today'
        ";

        // Ejecutar la consulta
        $result = $this->db->query($query);

        if (!$result) {
            // Manejo de errores
            echo "Error en la consulta: " . $this->db->error;
            return 0;
        }

        // Obtener el resultado
        $row = $result->fetch_assoc();
        return (int)$row['count'];
    }

    
    public function getCanceledAppointmentsCountToday() {
        // Obtener la fecha actual
        $today = date('Y-m-d');

        // Consulta para contar las citas atendidas del día actual
        $query = "
            SELECT COUNT(*) AS count
            FROM vista_citas_detalladas
            WHERE Estado_cita = 'Cancelada'
              AND Fecha_cita = '$today'
        ";

        // Ejecutar la consulta
        $result = $this->db->query($query);

        if (!$result) {
            // Manejo de errores
            echo "Error en la consulta: " . $this->db->error;
            return 0;
        }

        // Obtener el resultado
        $row = $result->fetch_assoc();
        return (int)$row['count'];
    }

    public function cancelAppointmentStatus($appointmentId) {
        // Limpiar el ID de la cita
        $appointmentId = clear($appointmentId);

        // Consulta para actualizar el estado de la cita
        $query = "
            UPDATE citas
            SET Estado_cita = 'Cancelada'
            WHERE idcita = '$appointmentId'
        ";

        // Ejecutar la consulta
        if (!$this->db->query($query)) {
            // Manejo de errores
            echo "Error al cancelar la cita: " . $this->db->error;
            return;
        }

        // Alerta de éxito
        alert("La cita fue cancelada!", 1, 'Agenda', 0);
        return;
    }


    public function updateAppointmentStatus($appointmentId) {
        // Limpiar el ID de la cita
        $appointmentId = clear($appointmentId);

        // Consulta para obtener el estado actual de la cita
        $query = "
            SELECT Estado_cita
            FROM citas
            WHERE idcita = '$appointmentId'
        ";
        $result = $this->db->query($query);

        if (!$result) {
            // Manejo de errores al obtener el estado actual
            echo "Error al obtener el estado actual de la cita: " . $this->db->error;
            return false;
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $estado_actual = $row['Estado_cita'];
            $nuevo_estado = null;

            // Determinar el nuevo estado basado en el estado actual
            if ($estado_actual == 'Pendiente') {
                $nuevo_estado = 'Confirmada';
            } elseif ($estado_actual == 'Confirmada') {
                $nuevo_estado = 'Realizada';
            }

            // Actualizar el estado de la cita si se ha determinado un nuevo estado
            if ($nuevo_estado !== null) {
                $update_query = "
                    UPDATE citas
                    SET Estado_cita = '$nuevo_estado'
                    WHERE idcita = '$appointmentId'
                ";
                if (!$this->db->query($update_query)) {
                    // Manejo de errores al actualizar el estado
                    echo "Error al actualizar la cita: " . $this->db->error;
                    return false;
                } else {
                    // Alerta de éxito
                    alert("La cita fue actualizada a $nuevo_estado con éxito!", 1, 'Agenda', 0);
                    return true;
                }
            } else {
              //  echo "Error al determinar el nuevo estado de la cita.";
                return false;
            }
        } else {
            echo "No se encontró la cita con el ID proporcionado.";
            return false;
        }
    }



}







?>