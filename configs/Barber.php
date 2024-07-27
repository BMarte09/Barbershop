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
    public function updateBarberStatus($barberId) {
        // Limpiar el ID del barbero
        $barberId = clear($barberId);
    
        // Consulta para obtener el estado actual del barbero
        $query = "
            SELECT Estado
            FROM barberos
            WHERE idBarbero = '$barberId'
        ";
        $result = $this->db->query($query);
    
        if (!$result) {
            // Manejo de errores al obtener el estado actual
            echo "Error al obtener el estado actual del barbero: " . $this->db->error;
            return false;
        }
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $estado_actual = $row['Estado'];
            $nuevo_estado = null;
    
            // Determinar el nuevo estado basado en el estado actual
            if ($estado_actual == 'Inactivo') {
                $nuevo_estado = 'Activo';
            } elseif ($estado_actual == 'Activo') {
                $nuevo_estado = 'Inactivo';
            }
    
            // Actualizar el estado del barbero si se ha determinado un nuevo estado
            if ($nuevo_estado !== null) {
                $update_query = "
                    UPDATE barberos
                    SET Estado = '$nuevo_estado'
                    WHERE idBarbero = '$barberId'
                ";
                if (!$this->db->query($update_query)) {
                    // Manejo de errores al actualizar el estado
                    echo "Error al actualizar el estado del barbero: " . $this->db->error;
                    return false;
                } else {
                    // Alerta de éxito
                    alert("El estado del barbero fue actualizado a $nuevo_estado con éxito!", 1, 'Barberos', 0);
                    return true;
                }
            } else {
                // Manejo de error si no se pudo determinar el nuevo estado
                echo "Error al determinar el nuevo estado del barbero.";
                return false;
            }
        } else {
            // Manejo de error si no se encontró el barbero con el ID proporcionado
            echo "No se encontró el barbero con el ID proporcionado.";
            return false;
        }

}
}
?>
