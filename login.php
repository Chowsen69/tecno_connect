<?php

    function mostrarSiExiste($indice){

        if(isset($_POST[$indice])){

            echo $_POST[$indice];

        }

    }

    require_once "app/controlador/C_Usuario.php";

    $usuario = new C_Usuario();

    session_start();

    unset($_SESSION["id_rol"]);

    unset($_SESSION["id_usuario"]);

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

    <?php

    if(isset($_POST["btn_login"])){

        $existe_gmail = $usuario->validarGmail($_POST["gmail"]);

        if($existe_gmail == false){ $_SESSION["msj"] = "No existe una cuenta con esa dirección de correo electrónico"; }else{

            $id_usuario = $usuario->validarClave($_POST["gmail"], $_POST["clave"]);

            if($id_usuario == false){ $_SESSION["msj"] = "Contraseña incorrecta"; }else{

                $id_usuario = $id_usuario;

                $caso = $usuario->definirRol($id_usuario);

                switch ($caso) {
                    case $caso[0] == 1:

                        // Administrador

                        $_SESSION["id_rol"] = $caso[1];

                        $_SESSION["id_usuario"] = $caso[2];

                        $_SESSION["id_tecnico"] = $caso[2];

                        $_SESSION["id_empresa"] = $caso[3];

                        header("Location: app/vista/adm.php");

                        break;

                    case $caso[0] == 2:

                        // Técnico

                        $_SESSION["id_rol"] = $caso[1];

                        $_SESSION["id_usuario"] = $caso[2];

                        $_SESSION["id_tecnico"] = $caso[2];

                        header("Location: app/vista/tec.php");

                        break;

                    case $caso[0] == 3:

                        // Empresa

                        $_SESSION["id_rol"] = $caso[1];

                        $_SESSION["id_usuario"] = $caso[2];

                        $_SESSION["id_empresa"] = $caso[3];

                        header("Location: app/vista/emp.php");

                        break;

                    case $caso[0] == 4:

                        // Registro incompleto

                        $_SESSION["id_usuario"] = $caso[2];

                        $_SESSION["id_rol"] = $caso[1];
                        
                        header("Location: registro.php");

                        break;
                    
                    default:

                        echo "Algo salió mal";

                        break;
                }
    
            }

        }

    }
    ?>

    <form action="login.php" method="POST">

        <h1>Login</h1>

        <?php

        if(isset($_SESSION["msj"])){

            echo $_SESSION["msj"] ."<br>";

            unset($_SESSION["msj"]);
            
        }

        ?>

        <label for="gmail">

            <span>Gmail (*)</span>

            <input type="email" name="gmail" id="gmail" placeholder="usuario@ejemplo.com" value="<?php mostrarSiExiste("gmail"); ?>" autofocus required>

        </label>

        <label for="clave">

            <span>Contraseña (*)</span>

            <input type="password" name="clave" id="clave" required>

        </label>

        <button type="submit" name="btn_login">Iniciar sesión</button>

    </form>

</body>

</html>