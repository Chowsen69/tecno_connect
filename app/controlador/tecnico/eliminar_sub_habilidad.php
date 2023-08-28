<?php

    if(isset($_GET["id_sub_habilidad"])){

        require_once "../../modelo/conexion.php";

        session_start();

        $query = "DELETE FROM t_r_sub_habilidad_servicio WHERE id_servicio = '$_SESSION[id_tecnico]' AND id_sub_habilidad = '$_GET[id_sub_habilidad]'";

        mysqli_query($con, $query);

        header("Location: ../../vista/perfil.php?id_usuario=". $_SESSION["id_usuario"] ."&id_rol=". $_SESSION["id_rol"]);

    }

?>