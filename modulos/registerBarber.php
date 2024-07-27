<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'configs/Database.php';
require_once 'configs/User.php';
  // Asegúrate de incluir el archivo de la clase User





if (isset($_POST['enviar'])) {


    // Limpiar y asignar variables
    $username = clear($_POST['email']);
    $password = clear($_POST['password']);
    $cpassword = clear($_POST['confirmpassword']);
    $nombre = clear($_POST['name']);
    $apellido = clear($_POST['lastname']);
    $celular = clear($_POST['phonenumber']);
    $rol = '2';

    $_SESSION['form_data'] = [
        'username' => $username,
        'password' => $password,
        'cpassword' => $cpassword,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'celular' => $celular
    ];
    
    $database = new Database();

    // Crear una instancia de la clase User
    $user = new User($database);

  
    $result = $user->registrar_usuario($username , $password, $cpassword,  $nombre, $apellido, $celular,$rol);


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

<section>
<div id="register" class="register-container">
       
    

        <div>
            <form class="Register-form" action="" method="POST">
        
        
                <h2 class="register_title">Crea tu cuenta como Barbero</h2>

                <div class=inputx>
                    
                <div class="form-group form-g-100%">
                   
                   <input type="email" class="custom-input" placeholder="Correo" id="email" name="email" required>
               </div>

               <div class="form-group">
                  
                  <input type="text" class="custom-input" placeholder="Nombre" id="name" name="name" value="<?php // get_value($name) ?>" required>
              </div>
              <div class="form-group">
                  
                  <input type="text" class="custom-input" placeholder="Apellido" id="lastname"  name="lastname" value="<?php // get_value($lastname)  ?>" required>
              </div>
             
              <div class="form-group">
                  
                  <input type="text" class="custom-input" placeholder="Numero telefonico" id="phonenumber" name="phonenumber" value="<?php  //get_value($phonenumber)?>"  required>
              </div>
              <div class="form-group">
                 
                 <input type="password" class="custom-input" placeholder="Confirmar contraseña" id="password" name="password" required >
             </div>
               <div class="form-group">
                 
                   <input type="password" class="custom-input" placeholder="Contraseña" id="confirmpassword" name="confirmpassword" required >
               </div>
               <div class="form-group">
                  
                  <input type="text" class="custom-input" placeholder="Direccion" id="direccion"  name="direccion" value="" required>
              </div>
               <div class="form-group">
                
                 
               <button type="submit" class="registrarse-button" name="enviar">Registrarse</button>
             </div>

                </div>
                

                <p class="register_label">Quieres registrarte como barbero? <a href="?p=register">Regístrate aqui</a></p> 
            </form>
            
</div> 

</section>
</body>
</html>

<script>
    // Verificar si hay datos del formulario en sesiones
    var formData = <?php echo isset($_SESSION['form_data']) ? json_encode($_SESSION['form_data']) : 'null'; ?>;
    
    // Si hay datos, restaurar los valores en los campos del formulario
    if (formData) {
        document.getElementById('email').value = formData.username;
        document.getElementById('password').value = formData.password;
        document.getElementById('confirmpassword').value = formData.cpassword;
        document.getElementById('name').value = formData.nombre;
        document.getElementById('lastname').value = formData.apellido;
        document.getElementById('phonenumber').value = formData.celular;
        
        // Limpiar los datos de sesión una vez restaurados
        <?php unset($_SESSION['form_data']); ?>
    }
</script> 