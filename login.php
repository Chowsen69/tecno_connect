<?php

    include("app/modelo/conexion.php");

    function mostrarSiExiste($name){

        if(isset($_POST[$name])){

            echo $_POST[$name];

        }

    }

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

    <h1>Login</h1>

    <form action="login.php" method="POST">

        <label for="gmail">

            <span>Gmail</span>

            <input type="email" name="gmail" id="gmail" value="<?php mostrarSiExiste("gmail"); ?>" required autofocus>

        </label>

        <label for="contrasena">

            <span>Contraseña</span>

            <input type="password" name="contrasena" id="contrasena" required>

        </label>

        <button name="btn_login">Iniciar Sesión</button>

    </form>

    <?php
    
        if(isset($_POST["btn_login"])){

            $gmail = $_POST["gmail"];

            $contrasena = $_POST["contrasena"];

            $query = "SELECT id_usuario, gmail, contrasena, id_rol FROM t_usuarios WHERE gmail = '$gmail' AND contrasena = '$contrasena'";

            $res = mysqli_query($con, $query);

            if(!mysqli_num_rows($res) == 1){ echo "Usuario o contraseña incorrectos"; }else{

                $fila = mysqli_fetch_array($res);

                $id_usuario = $fila["id_usuario"];

                $_SESSION["id_usuario"] = $fila["id_usuario"];

                $_SESSION["id_rol"] = $fila["id_rol"];

                if($fila["id_rol"] == 13){

                    $query = "SELECT id_empresa FROM t_empresas WHERE id_usuario = '$id_usuario'";

                    $res = mysqli_query($con, $query);

                    if(mysqli_num_rows($res) == 1){

                        $fila = mysqli_fetch_array($res);

                        $_SESSION["id_empresa"] = $fila["id_empresa"];

                        header("Location: app/vista_empresa/inicio.php");

                    }

                }else{

                    header("Location: app/vista_tecnico/inicio.php");

                }

            }

        }
    
    ?>

</body>

</html>