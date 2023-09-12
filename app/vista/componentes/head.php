<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tecno Connect</title>

</head>

<body>

    <?php
    define("AVATAR", "../../publico/img/avatar/");

    define("PORTADA", "../../publico/img/portada/");

    define("CURRICULUM", "../../publico/curriculum/");

    require_once "../modelo/conexion.php";
    
    session_start();

    require_once "header.php"; 

    // VALIDAR SI UN USUARIO ESTÁ VALIDADO
    $validado = mysqli_fetch_array(mysqli_query($con, "SELECT id_validacion FROM t_usuarios WHERE id_usuario = '$_SESSION[id_usuario]'"));

    switch($validado["id_validacion"]){

        case 1:

            // Validación en proceso

            $_SESSION["id_validacion"] = 1;

            header("Location: ../../");

            break;

        case 2:

            // Validación rechazada

            $_SESSION["id_validacion"] = 2;

            header("Location: ../../");

            break;

        case 3:

            // Validación aceptada

            $_SESSION["id_validacion"] = 3;

            break;

        default:

            echo "No pudimos corroborar tu validación";

            break;

    }
    
    ?>