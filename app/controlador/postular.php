<?php

    session_start();

    if(isset($_SESSION["id_tecnico"]) AND isset($_GET["id_propuesta"])){

        require_once "C://xampp/htdocs/tecno_connect/app/controlador/C_Postulante.php";

        $c_postulante = new C_Postulante();

        $id_tecnico = $_SESSION["id_tecnico"];

        $id_propuesta = $_GET["id_propuesta"];

        if($c_postulante->estaPostulado($id_tecnico, $id_propuesta)){

            $res = $c_postulante->despostularTecnico($id_tecnico, $id_propuesta);

            if($res){

                header("Location: ../vista/tec.php");

            }

        }else{

            $res = $c_postulante->postularTecnico($id_tecnico, $id_propuesta);

            if($res != false){
        
                header("Location: ../vista/tec.php");

            }

        }

    }

?>