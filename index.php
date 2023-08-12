<?php

    session_start();

    if(isset($_SESSION["id_usuario"])){

        if($_SESSION["id_rol"] == 13){

            header("Location: app/vista_empresa/inicio.php");

        }else{

            header("Location: app/vista_tecnico/inicio.php");

        }

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

    <header>

        <a href="index.php">Tecno Connect</a>

        <a href="login.php">Login</a>

    </header>

    <h1>Tecno Connect - Landing Page</h1>

</body>

</html>