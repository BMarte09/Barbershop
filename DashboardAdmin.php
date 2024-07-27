<?php
include "configs/config.php";
include "configs/funciones.php";

// Ejemplo de uso
$p = isset($_GET['p']) ? $_GET['p'] : 'citas_canceladas';


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alex´s Barbershop</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous"> <script src="https://kit.fontawesome.com/4ec4f15ca5.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="resources/css/style.css"/>
    <link rel="stylesheet" href="resources/css/StyleAdmin.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="app.js"></script>
	<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<title>AdminHub</title>
</head>

<body>


	<!-- SIDEBAR -->
	<nav class="navbar">
        <div class="navbar-brand">
            <img src="resources/images/Barbershop_Logo.png" alt="Logo" class="navbar-logo">
            <span class="navbar-name">Alex´s Barbershop</span>
        </div>
        <ul class="navbar-menu">
            <li class="navbar-item">
                <a href="?p=login" class="navbar-link"><i class="fas fa-home"></i> INICIO</a>
            </li>
            <li class="navbar-item">
                <a href="#" onclick="openModal('notificationModal')" class="navbar-link"><i class="fas fa-bell"></i> NOTICACIONES</a>
            </li>
            <li class="navbar-item">
                <a href="#" class="navbar-link"><i class="fas fa-sign-out-alt"></i> CERRAR SESIÓN</a>
            </li>
        </ul>
    </nav>

	<section id="sidebar">

		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Gestionar citas </span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Horarios</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-message-dots'></i>
					<span class="text">Servicios</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group'></i>
					<span class="text">Gestionar Barberos</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<div class="content">
		<?php
			if(file_exists("modulos/Admin".$p.".php")){
				include "modulos/Admin".$p.".php";
			}else{
				echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
			}
		?>

        
	</div>