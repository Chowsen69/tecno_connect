<?php

    session_start();

    unset($_SESSION["id_usuario"]);

    unset($_SESSION["id_rol"]);

    unset($_SESSION["id_empresa"]);

    session_destroy();

    header("Location: ../../login.php");

?>