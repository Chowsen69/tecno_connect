<?php 

require_once "componentes/head.php";

// ACCIONES DE USUARIOS
if(isset($_POST["btn_usuario"])){

    // CREO LA CARPETA DEL USUARIO CORRESPONDIENTE EN tecno_connect/publico/usuarios
    $url = $_SERVER["DOCUMENT_ROOT"] . "/tecno_connect/publico/usuarios/". $_SESSION["id_usuario"] . "/";

    if(!file_exists($url)){

        mkdir($url);

    }

    if(!file_exists($url . "avatar/")){

        mkdir($url . "avatar/");
    
    }

    if(!file_exists($url . "portada/")){

        mkdir($url . "portada/");
        
    }

    // Foto de perfil
    if($_FILES["avatar"]["name"] == ""){

        // Si no seleccionó ninguna foto de perfil

    }else{

        $avatar = uniqid() . $_FILES["avatar"]["name"];

        move_uploaded_file($_FILES["avatar"]["tmp_name"], $url . "avatar/" . $avatar);

    }

    if($_FILES["portada"]["name"] == ""){

        // Si no seleccionó ninguna foto de perfil

    }else{

        $portada = uniqid() . $_FILES["portada"]["name"];

        move_uploaded_file($_FILES["portada"]["tmp_name"], $url . "portada/" . $portada);

    }

    $update = "UPDATE t_usuarios SET avatar = '$avatar', portada = '$portada' WHERE id_usuario = '$_SESSION[id_usuario]'";

    mysqli_query($con, $update);

    header("location: perfil.php?id_usuario=". $_SESSION["id_usuario"] ."&id_rol=". $_SESSION["id_rol"]);

}

// ACCIONES DE TÉCNICO
if(isset($_POST["btn_servicio"])){

    // Codigo

}

?>

    <h1>Editar perfil</h1>

    <a href="perfil.php?id_usuario=<?= $_SESSION["id_usuario"] ?>&id_rol=<?= $_SESSION["id_rol"] ?>">Volver</a>

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

            ?>
            <a href='edit_servicios.php'>Editar servicios</a>
            <?php

        break;

    }

    ?>

<?php require_once "componentes/footer.php"; ?>