<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'barberiabd';
    public $mysqli;

    // Constructor que establece la conexión a la base de datos
    public function __construct() {
        $this->mysqli = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        // Manejo de errores en la conexión
        if ($this->mysqli->connect_error) {
            die('Error de conexión (' . $this->mysqli->connect_error . ') ' . $this->mysqli->connect_error);
        }
    }

    // Destructor que cierra la conexión a la base de datos
    public function close() {
        $this->mysqli->close();
    }
}
?>
