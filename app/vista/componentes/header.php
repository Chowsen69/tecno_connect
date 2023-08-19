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

    <a href="perfil.php?id_usuario=<?= $_SESSION["id_usuario"]; ?>&id_rol=<?= $_SESSION["id_rol"]; ?>">Perfil</a>

    <!-- MOVERSE ENTRE VISTAS (SÓLO ADMINISTRADOR) -->
    <?php
    
    if($_SESSION["id_rol"] == 15){

        ?>
        
        <a href="adm.php">Admin</a>

        <a href="emp.php">Empresa</a>

        <a href="tec.php">Técnico</a>

        <?php

    }

    ?>

    <a href="../controlador/cerrar_sesion.php">Cerrar sesión</a>

    <!-- Tres puntos -->
    <!-- <ul>

        <li>Modo oscuro</li>

        <li>Soporte</li>

        <li><a href="../controlador/cerrar_sesion.php">Cerrar sesión</a></li>

    </ul> -->

</header>