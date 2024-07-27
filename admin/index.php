

<?php
include "../configs/config.php";
include "../configs/funciones.php";

// Ejemplo de uso
$p = isset($_GET['p']) ? $_GET['p'] : 'estadisticas';


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
	<link rel="stylesheet" href="../resources/css/style.css"/>
    <link rel="stylesheet" href="../resources/css/StyleAdmin.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="app.js"></script>
	<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	

	<title>AdminHub</title>
	<style>
		
/* SIDEBAR */
#layout {
    display: flex;
    height: 100vh;
    overflow: hidden;
}

#sidebar {
	display: block;
	position:fixed;
	top: 0;
	left: 0;
	padding-top: 4.9rem;
	width: 250px;
	min-height: 100vh;
	background: #D33333;
	z-index: 20;
	font-family: var(--lato);
	transition: .3s ease;
	overflow-x: hidden;
	scrollbar-width: none;

}

.content-wrapper{
	margin-top: 8rem;
	display: flex;
    flex-direction: column;
    margin-left: 250px; /* Deja espacio para el sidebar */
    min-height: 100vh;
    width: calc(100% - 250px); /* Ajusta el ancho para el espacio del sidebar */
    padding: 1rem;
   
    box-sizing: border-box; /* Incluye padding en el ancho total */
	overflow-y: auto;
    display: flex;
    flex-direction: column; 
	padding-bottom: 12rem;
}

.content-wrapper > * {
    width: 100%; /* Ajusta el ancho de los elementos internos */
    margin: 0; /* Evita márgenes adicionales */
    padding: 0; /* Ajusta el padding si es necesario */
}


#sidebar::--webkit-scrollbar {
	display: none;
}
#sidebar.hide {
	width: 60px;
}
#sidebar .brand {
	font-size: 24px;
	font-weight: 700;
	height: 56px;
	display: flex;
	align-items: center;
	color: #fff;
	position: sticky;
	top: 0;
	left: 0;
	
	z-index: 500;
	padding-bottom: 20px;
	box-sizing: content-box;
}
#sidebar .brand .bx {
	min-width: 60px;
	display: flex;
	justify-content: center;
}
#sidebar .side-menu {
	width: 100%;
	margin-top: 48px;
}
#sidebar .side-menu li {
	height: 48px;
	background: transparent;
	margin-left: 6px;
	border-radius: 48px 0 0 48px;
	padding: 6px;
	
}
#sidebar .side-menu li.active {
	background: var(--grey);
	position: relative;
}
#sidebar .side-menu li.active::before {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	top: -40px;
	right: 0;
	box-shadow: 20px 20px 0 var(--grey);
	z-index: -1;
}
#sidebar .side-menu li.active::after {
	content: '';
	position: absolute;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	bottom: -40px;
	right: 0;
	box-shadow: 20px -20px 0 var(--grey);
	z-index: -1;
}
#sidebar .side-menu li a {
	width: 100%;
	height: 100%;
	
	display: flex;
	align-items: center;
	border-radius: 48px;
	font-size: 15px;
	color: #fff;
	white-space: nowrap;
	overflow-x: hidden;
}
#sidebar .side-menu.top li.active a {
	color: #342E37;
}
#sidebar.hide .side-menu li a {
	width: calc(48px - (4px * 2));
	transition: width .3s ease;
}

#sidebar .side-menu.top li a:hover {
	color: #978b8b;
}
#sidebar .side-menu li a .bx {
	min-width: calc(60px  - ((4px + 6px) * 2));
	display: flex;
	justify-content: center;
}
	</style>
</head>

<body>


	<!-- SIDEBAR -->
	<nav class="navbar">
        <div class="navbar-brand">
            <img src="../resources/images/Barbershop_Logo.png" alt="Logo" class="navbar-logo">
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

	<div id="layout">

	
	<aside id="sidebar">

		<ul class="side-menu top">
			<li class="">
				<a href="?p=estadisticas">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="?p=agenda">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Gestionar citas</span>
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
				<a href="?p=registrar_barberos">
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
	</aside>

	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<div id="content-wrapper" class="content-wrapper">
		<?php
			if(file_exists("modulos/".$p.".php")){
				include "modulos/".$p.".php";
			}else{
				echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
			}
		?>

        
	</div>

	</div>

</body><script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtén el parámetro 'p' de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get('p');

        // Si no hay parámetro 'p', puedes configurar un valor por defecto o manejarlo de otra forma
        if (!page) {
            return;
        }

        // Selecciona todos los elementos del menú
        const menuItems = document.querySelectorAll('#sidebar .side-menu li');

        // Recorre los elementos del menú
        menuItems.forEach(item => {
            // Verifica si el href del enlace coincide con el parámetro 'p'
            const link = item.querySelector('a');
            if (link && link.getAttribute('href').includes(`?p=${page}`)) {
                // Añade la clase activa al elemento de menú correspondiente
                item.classList.add('active');
            } else {
                // Quita la clase activa de los demás elementos
                item.classList.remove('active');
            }
        });
    });
</script>
