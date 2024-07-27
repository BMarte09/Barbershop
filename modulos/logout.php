<?php
require_once 'configs/funciones.php';

session_destroy();

alert("Ha sido cerrada la sesion", 1, 'login','2');
/*
echo "La sesión ha sido destruida.";
redir("login");*/

?>