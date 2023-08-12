<?php

    session_start();

    if(isset($_POST["btn_propuesta"])){

        include("../modelo/conexion.php");

        $id_empresa = $_SESSION["id_empresa"];

        $titulo = $_POST["titulo"];

        $desc = $_POST["desc"];

        $pago_min = $_POST["pago_min"];

        $query = "INSERT INTO t_propuestas(id_empresa, titulo, descripcion, pago_min, fecha_publicacion) VALUES ('$id_empresa', '$titulo', '$desc', '$pago_min', now())";

        $res = mysqli_query($con, $query);

        if($res){

            header("Location: ../vista_empresa/inicio.php");

        }else{

            echo "Algo salió mal a la hora de publicar la propuesta";

        }

    }

?>