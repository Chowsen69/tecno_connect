<?php

    function mostrarSiExiste($indice){

        if(isset($_POST[$indice])){

            echo $_POST[$indice];

        }

    }

    require_once "app/controlador/C_Usuario.php";
                    
    require_once "app/controlador/C_Empresa.php";
                    
    require_once "app/controlador/C_Tecnico.php";

    $usuario = new C_Usuario();

    $empresa = new C_Empresa();
    
    $tecnico = new C_Tecnico();

    session_start();

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tecno Connect</title>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>

<body>

    <header>

        <a href="index.php">Tecno Connect</a>

        <a href="login.php">Login</a>

        <a href="registro.php">Registro</a>

    </header>

    <?php 
    // REGISTRAR - PASO 1
    if(isset($_POST["btn_registrar_uno"])){

        if($usuario->validarGmail($_POST["gmail"])){ $_SESSION["msj"] = "Ese gmail ya está en uso, escoja otro"; }else{
            // EL GMAIL EXISTE EN LA BASE DE DATOS
            if($_POST["clave"] != $_POST["rep_clave"]){ $_SESSION["msj"] = "Las contraseñas no coinciden"; }else{
                
                // LAS CONTRASEÑAS COINCIDEN
                $id_usuario = $usuario->guardarUsuario($_POST["id_rol"], $_POST["gmail"], $_POST["clave"]);

                $_SESSION["id_usuario"] = $id_usuario;

                $_SESSION["id_rol"] = $_POST["id_rol"];

            }
        }

    // PASO DOS - REGISTRAR UNA EMPRESA
    }else if(isset($_POST["btn_registrar_empr"])){

        $id_usuario = $_SESSION["id_usuario"];

        $id_empresa = $empresa->guardarEmpresa($id_usuario, $_POST["nom_empr"], $_POST["cuit"], $_POST["localidad"], $_POST["sitio_web"], $_POST["tipo"], $_POST["tamano"]);

        if($id_empresa != false ){

            unset($_SESSION["id_usuario"]);

            unset($_SESSION["id_rol"]);

            $_SESSION["msj"] = "Felicidades, te registraste exitósamente";

            header("Location: login.php");

        }
    
    // PASO DOS - REGISTRAR UN TÉCNICO
    }else if(isset($_POST["btn_registrar_tec"])){

        $id_usuario = $_SESSION["id_usuario"];

        $id_tecnico = $tecnico->guardarTecnico($id_usuario, $_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["tecnica"], $_POST["especialidad"]);

        if($id_tecnico != false ){

            $_SESSION["msj"] = "Felicidades, te registraste exitósamente";

            unset($_SESSION["id_usuario"]);

            unset($_SESSION["id_rol"]);

            header("Location: login.php");

        }

    }

    ?>

    <?php if(empty($_SESSION["id_usuario"])): ?>
        <!-- FORMULARIO REGISTRO - PASO UNO -->
        <form action="registro.php" method="POST">

            <h1>Registro - Paso uno</h1>

            <?php
            
            if(isset($_SESSION["msj"])){

                echo $_SESSION["msj"] ."<br>";

                // unset($_SESSION["msj"]);

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

            <label for="rep_clave">

                <span>Repetir contraseña (*)</span>

                <input type="password" name="rep_clave" id="rep_clave" required>

            </label>

            <p>¿Qué quieres registrar? Decide bien, porque una vez escojes no hay vuelta atrás!</p>

            <div>

                <input type="radio" name="id_rol" id="empr" value="13">

                <label for="empr">Empresa</label>

            </div>

            <div>

                <input type="radio" name="id_rol" id="tec" value="14" required>
            
                <label for="tec">Técnico</label>
            
            </div>

            <div>

                <input type="checkbox" name="term_ser" id="term_ser" value="aceptado" required>

                <label for="term_ser">Acepto los términos de condiciones y servicios</label>

            </div>

            <button type="submit" name="btn_registrar_uno">Siguiente paso</button>

        </form>
    <?php elseif($_SESSION["id_rol"] == 13): ?>
        <!-- FORMULARIO PASO DOS - REGISTRAR UNA EMPRESA -->
        <form action="registro.php" method="POST">

            <h1>¡Un paso más</h1>

            <?php

            if(isset($_SESSION["msj"])){

                echo $_SESSION["msj"] ."<br>";

                // unset($_SESSION["msj"]);

            }

            ?>

            <label for="nom_empr">

                <span>Nombre de la empresa (*)</span>

                <input type="text" name="nom_empr" id="nom_empr" value="<?php mostrarSiExiste("nom_empr") ?>" required autofocus>

            </label>

            <label for="cuit">

                <span>Cuit (*)</span>

                <input type="text" name="cuit" id="cuit" value="<?php mostrarSiExiste("cuit") ?>" required>

            </label>
            
            <label for="localidad">

                <span>Localidad (*)</span>

                <input type="text" name="localidad" id="localidad" value="<?php mostrarSiExiste("localidad") ?>" required>

            </label>
            
            <label for="sitio_web">

                <span>Sitio web</span>

                <input type="url" name="sitio_web" id="sitio_web" value="<?php mostrarSiExiste("sitio_web") ?>">

            </label>
            
            <label for="sector">

                <span>Sector (*)</span>

                <input type="text" name="sector" id="sector" value="<?php mostrarSiExiste("sector") ?>" required>

            </label>
            
            <label for="tipo">

                <span>Tipo (*)</span>

                <select name="tipo" id="tipo" required>
                
                    <option value="" hidden>Seleccione el tipo</option>

                    <?php

                    $filas = $empresa->tiposEmpresas();

                    foreach($filas as $fila):

                        ?><option value="<?= $fila["id_tipo"] ?>"><?= $fila["tipo"] ?></option><?php

                    endforeach;

                    ?>

                </select>

            </label>
            
            <label for="tamano">

                <span>Tamaño (*)</span>

                <select name="tamano" id="tamano" required>
                
                    <option value="" hidden>Seleccione el tamaño</option>

                    <?php

                    $filas = $empresa->tamanosEmpresas();

                    foreach($filas as $fila):

                        ?><option value="<?= $fila["id_tamano"] ?>"><?= $fila["tamano"] ?></option><?php

                    endforeach;

                    ?>

                </select>

            </label>

            <button type="submit" name="btn_registrar_empr">Completar registro</button>

        </form>
    <?php elseif($_SESSION["id_rol"] == 14): ?>
        <!-- FORMULARIO PASO DOS - REGISTRAR UN TÉCNICO -->
        <form action="registro.php" method="POST">

            <h1>¡Un paso más!</h1>

            <?php

            if(isset($_SESSION["msj"])){

                echo $_SESSION["msj"] ."<br>";

                // unset($_SESSION["msj"]);

            }

            ?>

            <label for="nombre">

                <span>Nombre (*)</span>

                <input type="text" name="nombre" id="nombre" value="<?php mostrarSiExiste("nombre") ?>" autofocus required>

            </label>

            <label for="apellido">

                <span>Apellido (*)</span>

                <input type="text" name="apellido" id="apellido" value="<?php mostrarSiExiste("apellido") ?>" required>

            </label>

            <label for="dni">

                <span>Número de documento (*)</span>

                <input type="text" name="dni" id="dni" value="<?php mostrarSiExiste("dni") ?>" required>

            </label>
            
            <label for="tecnica">

                <span>Técnica (*)</span>

                <select name="tecnica" id="tecnica" required>
                
                    <option value="" hidden>Seleccione la técnica</option>

                    <?php

                    $filas = $tecnico->tecnicas();

                    foreach($filas as $fila):

                        ?><option value="<?= $fila["id_tecnica"] ?>"><?= $fila["tecnica"] ?></option><?php

                    endforeach;

                    ?>

                </select>

            </label>
            
            <label for="especialidad">

                <span>Especialidad (*)</span>

                <select name="especialidad" id="especialidad" required>
                
                    <option value="" hidden>Seleccione una especialidad</option>

                    <?php

                    $filas = $tecnico->especialidades();

                    foreach($filas as $fila):

                        ?><option value="<?= $fila["id_especialidad"] ?>"><?= $fila["especialidad"] ?></option><?php

                    endforeach;

                    ?>

                </select>

            </label>

            <button type="submit" name="btn_registrar_tec">Completar registro</button>

        </form>
    <?php endif; ?>

    <?php
    
    print_r($_SESSION);

    ?>

</body>

</html>