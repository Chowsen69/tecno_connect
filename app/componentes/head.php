<?php

    include("../modelo/conexion.php");

    session_start();

    if(empty($_SESSION["id_usuario"])){

        header("Location: ../../index.php");

    }

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tecno Connect</title>

</head>

<body>

    <?php 
    
        include("header.php"); 
    
        if($_SESSION["id_rol"] == 13){

            include("barra_lateral_emp.php");

        }else{

            include("barra_lateral_tec.php");

        }
        
    ?>