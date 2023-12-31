<?php

    function mostrarSiExiste($indice){

        if(isset($_POST[$indice])){

            echo $_POST[$indice];

        }

    }

    require_once "app/modelo/conexion.php";

    session_start();

    if(!empty($_SESSION["id_empresa"]) || !empty($_SESSION["id_tecnico"])){

        header("location: index.php");

    }

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
    // REGISTRAR - PASO UNO
    if(isset($_POST["btn_registrar_uno"])){

        // Valida que todos los inputs tengan un valor
        if(empty($_POST["gmail"]) || empty($_POST["clave"]) || empty($_POST["rep_clave"])){
        
            echo "<p>Rellene todos los campos</p>";

        // Valida que se haya seleccionado el rol (<input type="radio">)
        }else if(empty($_POST["id_rol"])){
        
            echo "<p>Marque la opción de empresa o técnico para continuar</p>";
        
        // Verifica que se haya marcado la casilla de términos de condiciones y servicios
        }else if(empty($_POST["term_ser"])){
        
            echo "<p>Acepte los términos de condiciones y servicios</p>";
        
        }else{
            
            // Verifica que el formato del gmail sea el correcto
            if (!filter_var($_POST['gmail'], FILTER_VALIDATE_EMAIL)) {
                
                echo "<p>El formato del email es inválido</p>";
            
            // Comprueba si el gmail utilizado ya está en uso
            }else if(mysqli_num_rows(mysqli_query($con, "SELECT gmail FROM t_usuarios WHERE gmail = '$_POST[gmail]'"))){
                
                echo "<p>Ese gmail ya está en uso, por favor escoja otro</p>";

            }else if(strlen($_POST["clave"]) < 8){

                echo "<p>Introduzca una clave de 8 o más dígitos</p>";

            }else if($_POST["clave"] != $_POST["rep_clave"]){
            
                echo "<p>Las contraseñas no coniciden</p>";
            
            }else{
                
                // Y SI LAS CONTRASEÑAS COINCIDEN
                $avatar = "por_defecto.png";
                
                $portada = "por_defecto.png";
                
                $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);
                
                if(mysqli_query($con, "INSERT INTO t_usuarios(id_rol, gmail, contrasena, avatar, portada, id_validacion, fecha_creacion) VALUES('$_POST[id_rol]', '$_POST[gmail]', '$clave', '$avatar', '$portada', '1', now())")){
                    
                    unset($_SESSION["msj"]);
                    
                    $_SESSION["id_usuario"] = mysqli_insert_id($con);
                    
                    $_SESSION["id_rol"] = $_POST["id_rol"];
                
                }else{
                    
                    $_SESSION["msj"] = "Lo sentimos, algo salió mal :(";
            
                }
        
            }

        }
    
    // BOTÓN DE CANCELAR
    }else if(isset($_POST["btn_cancelar"]) && empty($_SESSION["id_empresa"]) && empty($_SESSION["id_tecnico"])){

        $query = "DELETE FROM t_usuarios WHERE id_usuario = '$_SESSION[id_usuario]'";

        if(mysqli_query($con, $query)){

            unset($_SESSION["id_usuario"]);

            unset($_SESSION["id_rol"]);

        }else{

            echo "<p>Hubo un error a la hora de cancelar la petición :(</p>";

        }

    // PASO DOS - REGISTRAR UNA EMPRESA
    }else if(isset($_POST["btn_registrar_empr"])){
        
        // Valida que los input type="text" no estén vacíos
        if(empty($_POST["nom_empr"]) || empty($_POST["cuit"]) || empty($_POST["localidad"]) || empty($_POST["sector"])){

            echo "<p>Rellene todos los campos de texto</p>";

        // Valida que el cuit sean sólo números y 11 dígitos
        }else if(!is_numeric($_POST["cuit"]) || strlen($_POST["cuit"]) != 11){

            echo "<p>Introduzca un cuit válido</p>";

        }else if(empty($_POST["tipo"])){

            echo "<p>Seleccione el tipo de empresa</p>";

        }else if(empty($_POST["tamano"])){

            echo "<p>Seleccione el tamaño de su empresa</p>";

        }else{

            // PROCESAMIENTO DE TEXTO
            $nom_empr = trim(htmlentities($_POST["nom_empr"]));

            $localidad = trim(htmlentities(ucwords($_POST["localidad"])));

            $sitio_web = trim(htmlentities($_POST["sitio_web"]));

            $sector = trim(ucfirst(strtolower($_POST["sector"])));

            $query = "INSERT INTO t_empresas(id_usuario, nombre_empresa, cuit, localidad, sitio_web, sector, id_tipo, id_tamano, fecha_creacion) VALUES ('$_SESSION[id_usuario]', '$nom_empr', '$_POST[cuit]', '$localidad', '$sitio_web', '$sector', '$_POST[tipo]', '$_POST[tamano]', now())";
        
            if(mysqli_query($con, $query)){

                $_SESSION["msj"] = "Felicidades, te registraste exitósamente, ahora sólo queda esperar a que validen tu cuenta";

                unset($_SESSION["id_usuario"]);

                unset($_SESSION["id_rol"]);

                header("Location: login.php");

            }

        }
    
    // PASO DOS - REGISTRAR UN TÉCNICO
    }else if(isset($_POST["btn_registrar_tec"])){
        
        if(empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["dni"])){
        
            echo "<p>Rellene todos los campos de texto</p>";
        
        }else if(!is_numeric($_POST["dni"]) || strlen($_POST["dni"]) < 8){
        
            echo "<p>Introduzca un DNI válido</p>";

        }else if(empty($_POST["tecnica"])){
        
            echo "<p>Seleccione una técnica y una especialidad</p>";

        }else if(empty($_POST["especialidad"])){
        
            echo "<p>Seleccione una especialidad</p>";
            
        }else{

            // PROCESAMIENTO DE TEXTO
            $nombre = ucwords($_POST["nombre"]);

            $apellido = ucwords($_POST["apellido"]);

            $query = "INSERT INTO t_tecnicos(id_tecnico, nombre, apellido, dni, id_tecnica, id_especialidad, fecha_creacion) VALUES('$_SESSION[id_usuario]', '$nombre', '$apellido', '$_POST[dni]', '$_POST[tecnica]', '$_POST[especialidad]', now())";

            if(mysqli_query($con, $query)){

                $_SESSION["msj"] = "Felicidades, te registraste exitósamente, ahora sólo queda esperar a que validen tu cuenta";

                unset($_SESSION["id_usuario"]);

                unset($_SESSION["id_rol"]);

                header("Location: login.php");

            }

        }

    }

    ?>

    <!-- TÍTULO (REGISTRAR USUARIO/UN PASO MÁS) -->
    <h1><?php if(empty($_SESSION["id_rol"])): echo "Registrar usuario"; else: echo "Un paso más"; endif; ?></h1>

    <?php

    if(!empty($_SESSION["msj"])){

        echo $_SESSION["msj"] ."<br>";

        unset($_SESSION["msj"]);

    }

    ?>

    <!-- FORMULARIOS DE REGISTRO -->
    <?php  if(empty($_SESSION["id_usuario"])): ?>
        <!-- FORMULARIO REGISTRO - PASO UNO -->
        <form action="registro.php" method="POST">

            <label for="gmail">

                <span>Gmail (*)</span>
                
                <input type="text" name="gmail" id="gmail" placeholder="usuario@ejemplo.com" value="<?php mostrarSiExiste("gmail"); ?>" autofocus >
            
            </label>

            <label for="clave">

                <span>Contraseña (*)</span>
                
                <input type="password" name="clave" id="clave" value="<?php mostrarSiExiste("clave"); ?>">

            </label>

            <label for="rep_clave">

                <span>Repetir contraseña (*)</span>

                <input type="password" name="rep_clave" id="rep_clave" value="<?php mostrarSiExiste("rep_clave"); ?>" >
            
            </label>

            <p>¿Qué quieres registrar?</p>

            <div>
                
                <input type="radio" name="id_rol" id="empr" value="13" <?php if(isset($_POST["id_rol"]) && $_POST["id_rol"] == 13){ echo "checked"; } ?>>

                <label for="empr">Empresa</label>

            </div>

            <div>

                <input type="radio" name="id_rol" id="tec" value="14" <?php if(isset($_POST["id_rol"]) && $_POST["id_rol"] == 14){ echo "checked"; } ?>>
            
                <label for="tec">Técnico</label>
            
            </div>

            <div>

                <input type="checkbox" name="term_ser" id="term_ser" value="aceptado" <?php if(isset($_POST["term_ser"])){ echo "checked"; } ?>>

                <label for="term_ser">Acepto los términos de condiciones y servicios</label>

            </div>

            <button type="submit" name="btn_registrar_uno">Siguiente paso</button>

        </form>
    <?php elseif($_SESSION["id_rol"] == 13): ?>
        <!-- FORMULARIO PASO DOS - REGISTRAR UNA EMPRESA -->
        <form action="registro.php" method="POST">

            <label for="nom_empr">

                <span>Nombre de la empresa (*)</span>

                <input type="text" name="nom_empr" id="nom_empr" maxlength="100" value="<?php mostrarSiExiste("nom_empr") ?>"  autofocus>

            </label>

            <label for="cuit">

                <span>Cuit (*)</span>

                <input type="text" name="cuit" maxlength="11" id="cuit" value="<?php mostrarSiExiste("cuit") ?>" >

            </label>
            
            <label for="localidad">

                <span>Localidad (*)</span>

                <input type="text" name="localidad" id="localidad" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" maxlength="255" value="<?php mostrarSiExiste("localidad") ?>" >

            </label>
            
            <label for="sitio_web">

                <span>Sitio web</span>

                <input type="url" name="sitio_web" id="sitio_web" maxlength="255" value="<?php mostrarSiExiste("sitio_web") ?>">

            </label>
            
            <label for="sector">

                <span>Sector (*)</span>

                <input type="text" name="sector" id="sector" maxlength="255" value="<?php mostrarSiExiste("sector") ?>"  placeholder="A qué se dedica tu empresa">

            </label>
            
            <label for="tipo">

                <span>Tipo (*)</span>

                <select name="tipo" id="tipo">
                
                    <option value="" hidden>Seleccione el tipo</option>

                    <?php

                    $res = mysqli_query($con, "SELECT * FROM t_tipos");

                    while($fila = mysqli_fetch_array($res)){

                        ?><option value="<?=$fila["id_tipo"]?>" <?php if(!empty($_POST["tipo"]) && $_POST["tipo"] == $fila["id_tipo"]){ echo "selected"; } ?>><?=$fila["tipo"]?></option><?php

                    }

                    ?>

                </select>

            </label>
            
            <label for="tamano">

                <span>Tamaño (*)</span>

                <select name="tamano" id="tamano" >
                
                    <option value="" hidden>Seleccione el tamaño</option>

                    <?php

                    $res = mysqli_query($con, "SELECT * FROM t_tamanos");

                    while($fila = mysqli_fetch_array($res)){

                        ?><option value="<?=$fila["id_tamano"]?>" <?php if(!empty($_POST["tamano"]) && $_POST["tamano"] == $fila["id_tamano"]){ echo "selected"; } ?>><?=$fila["tamano"]?></option><?php

                    }

                    ?>

                </select>

            </label>

            <button name="btn_cancelar">Cancelar</button>

            <button type="submit" name="btn_registrar_empr">Completar registro</button>

        </form>
    <?php elseif($_SESSION["id_rol"] == 14): ?>
        <!-- FORMULARIO PASO DOS - REGISTRAR UN TÉCNICO -->
        <form action="registro.php" method="POST">

            <label for="nombre">

                <span>Nombre (*)</span>
                
                <input type="text" name="nombre" id="nombre" maxlength="100" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" value="<?php mostrarSiExiste("nombre") ?>" autofocus >

            </label>

            <label for="apellido">
                
                <span>Apellido (*)</span>
                
                <input type="text" name="apellido" id="apellido" maxlength="100" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" value="<?php mostrarSiExiste("apellido") ?>" >
            
            </label>
            
            <label for="dni">

                <span>Número de documento (*)</span>

                <input type="text" placeholder="Sin espacio ni guiones" name="dni" id="dni" maxlength="8" value="<?php mostrarSiExiste("dni") ?>" >
            
            </label>
            
            <label for="tecnica">
                
                <span>Técnica (*)</span>

                <select name="tecnica" id="tecnica">
                
                    <option value="" hidden>Seleccione la técnica</option>

                    <?php

                    $res = mysqli_query($con, "SELECT * FROM t_tecnicas");

                    while($fila = mysqli_fetch_array($res)){

                        ?><option value="<?= $fila["id_tecnica"] ?>" <?php if(!empty($_POST["tecnica"]) && $_POST["tecnica"] == $fila["id_tecnica"]){ echo "selected"; } ?>><?= $fila["tecnica"] ?></option><?php

                    }

                    ?>

                </select>

            </label>
            
            <label for="especialidad">

                <span>Especialidad (*)</span>

                <select name="especialidad" id="especialidad">
                
                    <option value="" hidden>Seleccione una especialidad</option>

                    <?php

                    $res = mysqli_query($con, "SELECT * FROM t_especialidades");

                    while($fila = mysqli_fetch_array($res)){

                        ?><option value="<?= $fila["id_especialidad"] ?>" <?php if(!empty($_POST["especialidad"]) && $_POST["especialidad"] == $fila["id_especialidad"]){ echo "selected"; } ?>><?= $fila["especialidad"] ?></option><?php

                    }

                    ?>

                </select>

            </label>

            <button name="btn_cancelar">Cancelar</button>

            <button type="submit" name="btn_registrar_tec">Completar registro</button>

        </form>
    <?php endif; ?>

    <script src="../../publico/js/validacion.js"></script>

</body>

</html>