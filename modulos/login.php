<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'configs/Database.php';
require_once 'configs/User.php';
// Inicia la sesión si no está iniciada



if (isset($_POST['ingresar'])) {


    // Limpiar y asignar variables
    $username = clear($_POST['email']);
    $password = clear($_POST['password']);
   
    $rol = '3';

    $_SESSION['login_data'] = [
        'username' => $username
       
      
    ];

    $database = new Database();

    // Crear una instancia de la clase User
    $user = new User($database);


$result= $user->iniciarSesion($username,$password);

    /*
    $q = $mysqli->query("SELECT * FROM Usuarios WHERE Correo = '$username' AND Contraseña = '$password'  AND Rol = '1'");

    if (mysqli_num_rows($q) > 0) {
        alert("Te has registrado satisfactoriamente.", 1,'/alexbarbershop/admin/','1');
    } else {
        $q = $mysqli->query("SELECT * FROM Usuarios WHERE Correo = '$username' AND Contraseña = '$password'  AND Rol = '3'");
    if (mysqli_num_rows($q) > 0) {
        // Obtener los datos del usuario
        $r = mysqli_fetch_array($q);
        $usuarioId= $r['Id'];

      echo "holaaa aaaaa";
        // Redirigir al Dashboard
  alert("Te has registrado satisfactoriamente.", 1, 'Dashboard','2');
       
    } else {
        // Si no se encontró el usuario, mostrar un mensaje de error y redirigir al login
        alert("Verifique sus datos e intente nuevamente", 0, 'login','2');
        die();
    }  

    if (isset($usuarioId)){
    $q = $mysqli->query("SELECT idCliente FROM clientes WHERE idUsuario = '$usuarioId'");
    $r = mysqli_fetch_array($q);
    $_SESSION['id_cliente']= $r['idCliente'];
   
    }
}*/
}
?>



<section>
<div id="login" class="login-container">
       
        <div class="section-img">
        
        <img src="resources\images\Barberia_background.png" alt="login form" class="login_icon" />
        <h1 class="barbershop-title">ALEX'S BARBERSHOP</h1>

        </div>


        <div class="login_back">
            <form class="login-form" action="" method="POST">
        
        
                <h2 class="label_login">Inicia sesión !</h2>
                <div class="form-group">
                   
                    <input type="email" class="custom-input" placeholder="Correo" id="email" name="email" required>
                </div>
                <div class="form-group password-container">
                  
                    <input type="password" class="custom-input" placeholder="Contraseña" id="password" name="password" required >
                </div>
               <button type="submit" name="ingresar" class="login-button btn"> Login</button>

               
               <!--<a href="?p=dashboard" class="btn-link">Login</a> -->
                <p class="register_label">No tienes una cuenta? <a href="?p=register">Regístrate</a></p>
            </form>
       

</div> 
</div>
</section>

<script>
    // Verificar si hay datos del formulario en sesiones
    var loginData = <?php echo isset($_SESSION['login_data']) ? json_encode($_SESSION['login_data']) : 'null'; ?>;
    
    // Si hay datos, restaurar los valores en los campos del formulario
    if (loginData) {
        document.getElementById('email').value = loginData.username;
        
        
        // Limpiar los datos de sesión una vez restaurados
        <?php unset($_SESSION['login_data']); ?>
    }
</script>