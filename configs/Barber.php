<?php
require_once 'Database.php';

class Barber {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->mysqli; // Usar la conexión mysqli de la instancia de Database
    }


    // Obtener todos los barberos
    public function getAllBarbers() {
        $barbers = [];
        $query = "SELECT * FROM barberos";
        $result = $this->db->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $barbers[] = $row;
            }
            // Liberar el resultado
            $result->free();
        } else {
            // Manejo de errores
            echo "Error en la consulta: " . $this->db->error;
        }

        return $barbers;
    }

    public function changeUserStatus($barberId) {
        // Limpiar el ID de la cita
        $barberId = clear($barberId);

        // Consulta para actualizar el estado de la cita
        $query = "
            UPDATE barberos
            SET Estado = 'Activo'
            WHERE idBarbero = '$barberId'
        ";

        // Ejecutar la consulta
        if (!$this->db->query($query)) {
            // Manejo de errores
            echo "Error al cancelar la cita: " . $this->db->error;
            return;
        }

        // Alerta de éxito
        alert("El usuario del barbero fue actualizada!", 1, 'Agenda', 0);
        return;
    }

}
?>
