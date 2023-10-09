<?php

session_start();

include("../../modelo/conexion.php");

if(isset($_GET["id_propuesta"])){
    
    mysqli_query($con, "DELETE FROM t_propuestas WHERE id_propuesta = '$_GET[id_propuesta]'");

    header("Location: ../../vista/perfil.php?id_usuario=". $_SESSION["id_usuario"] ."&id_rol=". $_SESSION["id_rol"]);

}else{

    echo "No existe una propuesta";

}

?>