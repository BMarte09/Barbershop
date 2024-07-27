<<?php
require_once 'Database.php';
require_once 'funciones.php';

class User {
    private $db;


    public function __construct(Database $database) {
        $this->db = $database ->mysqli;
    }
        //REGISTRAR USUARIO

    public function registrar_usuario($email, $password, $cpassword, $name, $lastname, $phonenumber,$rol) {
        $email = clear($email);
        $password = clear($password);
        $cpassword = clear($cpassword);
        $name = clear($name);
        $lastname = clear($lastname);
        $phonenumber = clear($phonenumber);
        
       // $adress = clear($adress);

        // Verificar si el correo ya está en uso
        

        if($this->isEmailInUse($email)){
            alert("El usuario ya está en uso", 0, 'register', 0);
            return;
        }

        // Verificar si las contraseñas coinciden
        if ($password !== $cpassword) {
            alert("Las contraseñas no coinciden.", 0, 'register', 0);
            return;
        }

        if($rol==3){
        // Insertar en la tabla Usuarios
        $query = "INSERT INTO Usuarios (Correo, Contraseña, Rol) VALUES ('$email', '$password', 3)";
        if (!$this->db->query($query)) {
            die("Error al insertar el usuario: " . $this->db->error);
        }

        // Obtener el id del usuario recién creado
        $query = "SELECT Id FROM Usuarios WHERE Correo = '$email'";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        $idUsuarioNuevo = $row['Id'];

        $this->registerCostumer($email,$name, $lastname, $phonenumber,$idUsuarioNuevo);
        return;

    }else if($rol==2){
        $query = "INSERT INTO Usuarios (Correo, Contraseña, Rol) VALUES ('$email', '$password', 2)";
        if (!$this->db->query($query)) {
            die("Error al insertar el usuario: " . $this->db->error);
        }

        // Obtener el id del usuario recién creado
        $query = "SELECT Id FROM Usuarios WHERE Correo = '$email'";
        $result = $this->db->query($query);
        $row = $result->fetch_assoc();
        $idUsuarioNuevo = $row['Id'];
        $this->registerBarber($name,$lastname,$phonenumber,$email, $idUsuarioNuevo);
        return;

    }      
    }


 //iNICIAR SESION
    public function iniciarSesion($email, $password) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $email = clear($email);
        $password =clear($password);

        // Verificar si el usuario es administrador
        if($this->isAdmin($email,$password)){
            alert("Inicio de sesión exitoso como administrador", 1,'/alexbarbershop/admin/','1');
            return;
        }

        // Verificar si el usuario es Barbero
        if($this->isBarber($email,$password)){
            alert("Inicio de sesión exitoso como Barbero", 1,'Dashboard','2');
            return;
        }
        if($this->validateCustomer($email,$password)){
        
            alert("Te has registrado satisfactoriamente.", 1, 'Dashboard','2');
            return;
        }
            alert("Verifique sus datos e intente nuevamente", 0, 'login','2');
            die(); 
            return;  
        
        
    }

    

    public function isEmailInUse($email) {
        $email = clear($email); // Limpia el correo electrónico

        // Consulta para verificar si el correo electrónico ya existe
        $query = "SELECT * FROM Usuarios WHERE Correo = '$email'";
        $result = $this->db->query($query);

        if ($result === false) {
            die("Error en la consulta: " . $this->db->error);
        }

        // Verifica si hay algún registro con el correo electrónico proporcionado
        if ($result->num_rows > 0) {
          
            return true; // Correo electrónico ya en uso
        }

        return false; // Correo electrónico no está en uso
    }


    function isBarber($email, $password) {
        $query = $this->db->query("SELECT * FROM Usuarios WHERE Correo = '$email' AND Contraseña = '$password'  AND Rol = '2'");
        if ($query->num_rows > 0) {
           
                return true;
            } else {
               
                return false;
            }
 }


    function isAdmin($email, $password) {
        $query = $this->db->query("SELECT * FROM Usuarios WHERE Correo = '$email' AND Contraseña = '$password'  AND Rol = '1'");
        if ($query->num_rows > 0) {
           
                return true;
            } else {
               
                return false;
            }
 }

 function validateCustomer($email, $password) {
   
    $query = $this->db->query("SELECT * FROM Usuarios WHERE Correo = '$email' AND Contraseña = '$password' AND Rol = '3'");
    if ($query->num_rows > 0) {
        $user = $query->fetch_assoc(); 
        $clienteId = $this->getClienteId($user['Id']);   
        if ($clienteId) {
            $_SESSION['id_cliente'] = $clienteId;
        }
        return true;
    } else {
       
        return false;
    }
}

public function getClienteId($userId) {
    $query = $this->db->query("SELECT idCliente FROM clientes WHERE idUsuario = '$userId'");
    if ($query->num_rows > 0) {
        $cliente = $query->fetch_assoc();
        return $cliente['idCliente'];
    } else {
        return null;
    }
}

public function registerCostumer($name, $lastname, $phonenumber, $email,$idUsuarioNuevo){
// Insertar en la tabla Clientes
$query = "INSERT INTO Clientes (Nombre, Apellido, Celular, Correo, idUsuario) VALUES ('$name', '$lastname', '$phonenumber', '$email', '$idUsuarioNuevo')";
if (!$this->db->query($query)) {
    die("Error al insertar en la tabla clientes " . $this->db->error);
    return;
}

alert("Te has registrado satisfactoriamente.",1,'login',0);
return;

}

public function registerBarber($name, $lastname, $phonenumber, $email,$idUsuarioNuevo){
    // Insertar en la tabla Clientes
    $query = "INSERT INTO narberos (Nombre, Apellido, Celular, Correo, idUsuario, Estado) VALUES ('$name', '$lastname', '$phonenumber', '$email', '$idUsuarioNuevo','Pendiente')";
    if (!$this->db->query($query)) {
        die("Error al insertar en la tabla barberos " . $this->db->error);
        return;
    }
    
    alert("Te has registrado satisfactoriamente.",1,'login',0);
    return;
    
    }
    
}

?>
