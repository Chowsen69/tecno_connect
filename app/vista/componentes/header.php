<?php

    // SWITCH CASE PARA DETERMINAR EL URL DE LA PÁGINA DE INICIO

    switch ($_SESSION["id_rol"]) {

        case 15:

            $url_inicio = "adm.php";

            break;

        case 14:
        
            $url_inicio = "tec.php";
        
            break;

        case 13:
        
            $url_inicio = "emp.php";
        
            break;
        
        default:

            # code...

            break;
            
    }

    ?>
    
<header>

    <a href="<?= $url_inicio ?>">Tecno Connect</a>

    <input type="search" name="busqueda" id="busqueda">

    <a href="../controlador/cerrar_sesion.php">Cerrar sesión</a>

</header>