<?php 

require_once "componentes/head.php";

// ACCIONES DE USUARIOS
if(isset($_POST["btn_usuario"])){

    // CREO LA CARPETA DEL USUARIO CORRESPONDIENTE EN tecno_connect/publico/usuarios

    // Foto de perfil
    if($_FILES["avatar"]["name"] == ""){

        // Si no seleccionó ninguna foto de perfil
        $avatar = mysqli_fetch_array(mysqli_query($con, "SELECT avatar FROM t_usuarios WHERE id_usuario = '$_SESSION[id_usuario]'"))["avatar"];

    }else{

        $avatar = "usuario". $_SESSION["id_usuario"] .".". pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);

        if(file_exists(AVATAR . $avatar)){
            unlink(AVATAR . $avatar);
        }

        move_uploaded_file($_FILES["avatar"]["tmp_name"], AVATAR . $avatar);

    }

    if($_FILES["portada"]["name"] == ""){

        // Si no seleccionó ninguna foto de portada
        $portada = mysqli_fetch_array(mysqli_query($con, "SELECT portada FROM t_usuarios WHERE id_usuario = '$_SESSION[id_usuario]'"))["portada"];

    }else{

        $portada = "usuario". $_SESSION["id_usuario"] .".". pathinfo($_FILES["portada"]["name"], PATHINFO_EXTENSION);

        if(file_exists(PORTADA . $portada)){
            unlink(PORTADA . $portada);
        }

        move_uploaded_file($_FILES["portada"]["tmp_name"], PORTADA . $portada);

    }

    $update = "UPDATE t_usuarios SET avatar = '$avatar', portada = '$portada' WHERE id_usuario = '$_SESSION[id_usuario]'";

    mysqli_query($con, $update);

    header("location: perfil.php?id_usuario=". $_SESSION["id_usuario"] ."&id_rol=". $_SESSION["id_rol"]);

}

?>

    <a href="perfil.php?id_usuario=<?= $_SESSION["id_usuario"] ?>&id_rol=<?= $_SESSION["id_rol"] ?>">Volver</a>

    <h1>Editar perfil</h1>
    
    <form action="edit_perfil.php" method="POST" enctype="multipart/form-data">

        <label for="avatar">

            <span>Foto de perfil</span>

            <input type="file" name="avatar" id="avatar">

        </label> 
        
        <label for="portada">

            <span>Foto de portada</span>

            <input type="file" name="portada" id="portada">

        </label> 

        <button type="submit" name="btn_usuario">Guardar cambios</button>

    </form>

    <?php
    
    switch($_SESSION["id_rol"]){

        case 14:
            // técnico

            include("editar/servicios.php");

        break;

    }

    ?>

<?php require_once "componentes/footer.php"; ?>