<?php
require_once '../configs/Database.php';

require_once '../configs/Barber.php';


$database = new Database();
$barber = new Barber($database);

$allBarbers = $barber->getAllBarbers();

if (isset($_POST['agendar'])) {
    // Limpiar y asignar variables
    $id_cliente = clear($_POST['cliente']);
    $barber = clear($_POST['barbero']);
    $date = clear($_POST['fecha']);
    $time = clear($_POST['hora']);
    $service = clear($_POST['servicio']);
}




if (isset($_GET['cancelar'])) {
}


/*
*/
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Citas</title>
    <style>
        /* Estilos básicos para la tabla */

        .agenda_container {
            flex: 1;
            /* Ocupa el espacio disponible en .content-wrapper */
            overflow-y: auto;
            /* Permite desplazamiento vertical si el contenido excede */
            padding: 1rem;
            /* Espacio interno para evitar el desbordamiento */

            box-sizing: border-box;
            /* Incluye padding en el tamaño total */
        }

        /* Estilo para la tabla */
        table {
            width: 100%;
            /* Asegura que la tabla ocupe todo el ancho del contenedor */
            border-collapse: collapse;
            /* Colapsa los bordes para evitar espacios entre ellos */
            table-layout: fixed;
            /* Ajusta el diseño de la tabla para que se ajuste al ancho del contenedor */
        }

        /* Estilo para celdas de tabla */
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            word-wrap: break-word;
            /* Asegura que el texto largo se ajuste */
        }

        /* Estilo para los encabezados de tabla */
        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        /* Estilo para la fecha seleccionada */
        .selected-date {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        /* Estilo para el input de fecha */
        .date-filter {
            margin-bottom: 20px;
        }

        /* Estilo para el mensaje de no resultados */
        .no-results {
            text-align: center;
            margin-top: 5rem;
            font-size: 1em;
            opacity: 0.8;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: space-around;

        }

        .fa-magnifying-glass {
            font-size: 15rem;
            color: red;
            opacity: 0.5;
            text-align: center;
            padding-top: 2rem;
        }
    </style>
</head>

<body>

    <div class="agenda_container">


        <h2 class="register_title">Listado de Barberos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><i class="fa-solid fa-user agenda-icon"></i> Nombre completo</th>
                    <th><i class="fa-solid fa-envelope agenda-icon"></i> Correo</th>
                    <th><i class="fa-solid fa-phone agenda-icon"></i> Celular</th>
                    <th><i class="fa-solid fa-toggle-on agenda-icon"></i> Estado</th>
                    <th><i class="fa-solid fa-list-check agenda-icon"></i> Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body">


                <?php foreach ($allBarbers as $rp) : ?>
                    <tr>
                        <td><?= $rp['Nombre'] ?> <?= $rp['Apellido'] ?></td>
                        <td><?= $rp['Correo'] ?></td>
                        <td><?= $rp['Celular'] ?></td>
                        <td><?= $rp['Estado'] ?></td>
                        <td>
                            <a href="?p=barberos&edit=<?= $rp['idBarbero'] ?>"><i class="fa-solid fa-edit agenda-icon"></i></a>
                            &nbsp;
                            <a href="?p=barberos&delete=<?= $rp['idBarbero'] ?>"><i class="fa fa-trash agenda-icon"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <div id="" class="no-results" <?php if (count($allBarbers) > 0) {
                                                        echo 'style="display: none;"';
                                                    } ?>>
                </tr>

            </tbody>
        </table>

    </div>



    </div>
</body>

</html>