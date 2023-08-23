<?php 

require_once "componentes/head.php";

// ACCIONES (CUANDO SE APRETA UN BOTÓN)

// ACCIONES DE TÉCNICO
if(isset($_POST["btn_servicio"])){

    require_once "../controlador/C_Servicio.php";

    $obj_servicio = new C_Servicio();

    $obj_servicio->guardarServicios($_SESSION["id_usuario"], $_POST["perfil_tec"], $_POST["ubicacion"]);

    print_r($_POST);

}

?>

    <h1>Editar perfil</h1>

    <a href="perfil.php?id_usuario=<?= $_SESSION["id_usuario"] ?>&id_rol=<?= $_SESSION["id_rol"] ?>">Volver</a>

    <?php
    
    switch($_SESSION["id_rol"]){

        case 14:

            ?>
            
            <form action="edit_perfil.php" method="POST">

                <h2>Tus servicios</h2>
<br>
                <label for="perfil_tec">

                    <span>Perfil técnico</span>

                    <textarea name="perfil_tec" id="perfil_tec" rows="5" cols="50"></textarea>

                </label>
<br><br><br>
                <div>

                    <span>Ubicación</span>

                    <div>

                        <input type="radio" name="ubicacion" id="remoto" value="1">

                        <label for="remoto">Remoto</label>

                        <input type="radio" name="ubicacion" id="fisico" value="1">

                        <label for="remoto">Físico</label>

                        <input type="radio" name="ubicacion" id="hibrido" value="1">

                        <label for="remoto">Híbrido</label>

                    </div>

                </div>
            <br>
                <?php
                
                require_once "C://xampp/htdocs/tecno_connect/app/controlador/C_Servicio.php";

                $obj_servicio = new C_Servicio();

                $obj_servicio->listaSubHabilidades();

                ?>

                <button type="submit" name="btn_servicio">Guardar cambios</button>

            </form>

            <?php

        break;

    }

    ?>

<?php require_once "componentes/footer.php"; ?>