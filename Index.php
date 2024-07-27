
<?php
include "configs/config.php";
require_once "configs/funciones.php";

// Ejemplo de uso
$p = isset($_GET['p']) ? $_GET['p'] : 'login';



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alex´s Barbershop</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous"> <script src="https://kit.fontawesome.com/4ec4f15ca5.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="./resources/css/style.css"/>
    <link rel="stylesheet" href="resources/css/StyleAdmin.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="app.js"></script>
	<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<nav class="navbar">
        <div class="navbar-brand">
            <img src="resources/images/Barbershop_Logo.png" alt="Logo" class="navbar-logo">
            <span class="navbar-name">Alex´s Barbershop</span>
        </div>
        <ul class="navbar-menu">
            <?php if(isset(($_SESSION['id_cliente']))){ ?>
            <li class="navbar-item">
                <a href="?p=login" class="navbar-link"><i class="fas fa-home"></i> INICIO</a>
            </li>
            <li class="navbar-item">
                <a href="#" onclick="openModal('notificationModal')" class="navbar-link"><i class="fas fa-bell"></i> NOTICACIONES</a>
            </li>
            <li class="navbar-item">
                <a href="?p=logout" class="navbar-link"><i class="fas fa-sign-out-alt"></i> CERRAR SESIÓN</a>
            </li>
            <?php } ?>
        </ul>
    </nav>

<div class="content">
		<?php
			if(file_exists("modulos/".$p.".php")){
				include "modulos/".$p.".php";
			}else{
				echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
			}
		?>

        
	</div>

</body>
</html>