<?php

    if(isset($_POST["btn_propuesta"])){

        require_once "../../modelo/conexion.php";

        session_start();

        // RECIBO LOS DATOS ENVIADOS POR POST
        $id_empresa = $_SESSION["id_empresa"];

        $titulo = htmlentities($_POST["titulo"]);

        $descr = htmlentities($_POST["descr"]);
        
        $pago_min = htmlentities($_POST["pago_min"]);
        
        if(empty($_POST["limite"])){
        
            $limite = "2024-06-20";

        }else{

            $limite = $_POST["limite"]; // Lo guarda como "yyyy-mm-dd"

        }
        
        $query = "INSERT INTO t_propuestas(id_empresa, titulo, descr, pago_min, limite, fecha_publicacion) VALUES('$id_empresa', '$titulo', '$descr', '$pago_min', '$limite', now())";
        
        if(mysqli_query($con, $query)){
        
            header("Location: ../../vista/emp.php");
        
        }

    }

?>