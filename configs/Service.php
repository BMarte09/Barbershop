<?php
require_once 'Database.php';

class Service {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->mysqli; // Usar la conexión mysqli de la instancia de Database
    }

    // Método para obtener todos los servicios
    public function getNameAllServices() {
        $services = [];
        $query = "SELECT idServicio, Nombre FROM servicios";
        $result = $this->db->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
            $result->free(); // Liberar el resultado
        } else {
            // Manejo de errores
            echo "Error en la consulta: " . $this->db->error;
        }

        return $services;
    }

    public function getTotalDailyIncome() {
        $today = date('Y-m-d'); // Obtener la fecha actual en formato 'YYYY-MM-DD'
    
        // Consulta para sumar las tarifas de todos los servicios del día actual
        $query = "
            SELECT SUM(tarifa_servicio) AS total_tarifa
            FROM vista_citas_servicio
            WHERE Fecha_cita = '$today' AND Estado_cita = 'Realizada'
        ";
    
        $result = $this->db->query($query);
    
        if ($result) {
            $row = $result->fetch_assoc();
            // Manejar el caso donde no hay resultados
            $totalTarifa = $row['total_tarifa'] !== null ? $row['total_tarifa'] : 0;
            $result->free(); // Liberar el resultado
        } else {
            // Manejo de errores
            echo "Error en la consulta: " . $this->db->error;
            $totalTarifa = 0; // Valor predeterminado en caso de error
        }
    
        return $totalTarifa;
    }

    function getMonthlyIncome() {
        $query = "
            SELECT 
                DATE_FORMAT(Fecha_cita, '%Y-%m') AS mes,
                SUM(tarifa_servicio) AS total_tarifa
            FROM 
                vista_citas_servicio
            WHERE 
                Estado_cita = 'Realizada'
            GROUP BY 
                mes
            ORDER BY 
                mes;
        ";
    
        $result = $this->db->query($query);
    
        $ingresosMensuales = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Convertir 'YYYY-MM' al nombre del mes
            $dateObj = DateTime::createFromFormat('Y-m', $row['mes']);
            $mesNombre = $dateObj->format('F Y'); // Ejemplo: July 2024

            $ingresosMensuales[$mesNombre] = $row['total_tarifa'];
        }
        $result->free(); // Liberar el resultado
    } else {
        // Manejo de errores
        echo "Error en la consulta: " . $this->db->error;
    }

    /* Depuración
    echo '<pre>';
    print_r($ingresosMensuales);
    echo '</pre>';*/

    return $ingresosMensuales;
    }
    
    
}
?>
