<?php 

require_once "componentes/head.php";

// ACCIONES DE TÉCNICO
if(isset($_POST["btn_servicio"])){

    // Codigo

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

                <label for="perfil_tec">

                    <span>Perfil técnico</span>

                    <textarea name="perfil_tec" id="perfil_tec" rows="5" cols="50"></textarea>

                </label>

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
                
                <?php

                ?>

                <button type="submit" name="btn_servicio">Guardar cambios</button>

            </form>

            <?php

        break;

    }

    ?>

<?php require_once "componentes/footer.php"; ?>