<?php

session_start();

switch ($_SESSION["id_rol"]) {

    case 15:

        header("Location: app/vista/adm.php");

        break;

    case 14:
    
        header("Location: app/vista/tec.php");
    
        break;

    case 13:
    
        header("Location: app/vista/emp.php");
    
        break;
    
    default:

        # code...

        break;
        
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

        <a href="registro.php">Registro</a>

    </header>

    <h1>Tecno Connect - Landing Page</h1>

</body>

</html>

<!-- 

    NORMAS DE CODIFICACIÓN:

        Variables: el nombre de las variables se declararán con snake_case

        Funciones: para declarar las funciones vamos a usar camelCase

        Variables constantes: para declarar variables constantes usamos MAYUS_SNAKE_CASE

        Espacios: entre línea y línea, SIEMPRE dejo un espacio de más para que el código sea más legible

        Idioma: todos los nombres (carpetas, archivos, variables, etc) van estar en español

    BASE DE DATOS:

        general: todos los nombres van a estar en minúscula

        nombre de tablas: "t" + "_" + nombre_de_la_tabla_en_plural

        nombre de las id: "id" + "_" + nombre_de_la_tabla_en_singular

-->