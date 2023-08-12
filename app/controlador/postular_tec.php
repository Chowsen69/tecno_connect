<?php

    include("../modelo/conexion.php");

    session_start();

    if(isset($_GET["id_propuesta"])){

        $id_usuario = $_SESSION["id_usuario"];

        $id_propuesta = $_GET["id_propuesta"];

        $query = "INSERT INTO t_postulantes(id_tecnico, id_propuesta) VALUES ('$id_usuario', '$id_propuesta')";

        $res = mysqli_query($con, $query);

        if($res){

            header("Location: ../vista_tecnico/inicio.php");

        }else{

            echo "Hubo un error a la hora de postular al técnico";

        }

    }

?>