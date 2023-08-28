<?php

    if(isset($_GET["id_propuesta"])){

        require_once "../../modelo/conexion.php";

        session_start();

        if($_GET["accion"] == 1){

            // POSTULAR TÉCNICO
            $query = "INSERT INTO t_postulantes(id_tecnico, id_propuesta) VALUES('$_SESSION[id_tecnico]', '$_GET[id_propuesta]')";

            if(mysqli_query($con, $query)){

                header("Location: ../../vista/tec.php");

            }

        }else{

            $query = "DELETE FROM t_postulantes WHERE id_tecnico = '$_SESSION[id_tecnico]' AND id_propuesta = '$_GET[id_propuesta]'";

            mysqli_query($con, $query);

            header("Location: ../../vista/tec.php");

        }

    }

?>