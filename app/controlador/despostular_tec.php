<?php

    include("../modelo/conexion.php");

    session_start();

    if(isset($_GET["id_propuesta"])){

        $id_usuario = $_SESSION["id_usuario"];

        $id_propuesta = $_GET["id_propuesta"];

        $query = "DELETE FROM t_postulantes WHERE id_tecnico = '$id_usuario' AND id_propuesta = '$id_propuesta'";

        $res = mysqli_query($con, $query);

        header("Location: ../vista_tecnico/inicio.php");

    }

?>