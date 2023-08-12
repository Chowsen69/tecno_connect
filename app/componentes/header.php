<header>

    <a href="inicio.php">Tecno Connect</a>

    <input type="search">

    <?php
    
        if($_SESSION["id_rol"] == 13){

            ?><a href="perfil_emp.php?id_empresa=<?php echo $_SESSION["id_empresa"]; ?>">Perfil</a><?php

        }else{

            ?><a href="perfil_tec.php?id_usuario=<?php echo $_SESSION["id_usuario"]; ?>">Perfil</a><?php

        }

    ?>

    <ul>

        <li>Soporte</li>

        <li>Modo oscuro</li>

        <li><a href="../controlador/cerrar_sesion.php">Cerrar sesión</a></li>

    </ul>

</header>