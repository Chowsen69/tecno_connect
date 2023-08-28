<?php require_once "componentes/head.php";

    function rellenar($atributo){

        if(isset($_POST["$atributo"])){

            echo $atributo;

        }

    }

    if($_SESSION["id_tecnico"] == false){

        header("Location: ../../");

    }

    if(isset($_POST["btn_servicios"])){

        If para comprobar si el técnico ya tiene un servicio cargado
        if(mysqli_num_rows(mysqli_query($con, "SELECT id_servicio FROM t_servicios WHERE id_servicio = '$_SESSION[id_tecnico]'")) == 0){

            $insert = "INSERT INTO t_servicios(id_servicio, perfil_tec, id_ubicacion) VALUES('$_SESSION[id_tecnico]', '$_POST[perfil_tec]', '$_POST[ubicacion]')";

            if(mysqli_query($con, $insert)){

                echo "Se insertó correctamente";

            }

        }else{

            $update = "UPDATE t_servicios SET perfil_tec = '$_POST[perfil_tec]', id_ubicacion = '$_POST[ubicacion]'";

            if(mysqli_query($con, $update)){

                echo "Se actualizó correctamente";

            }

        }

        // SUB - HABILIDADES
        $sub_habilidades = mysqli_query($con, "SELECT * FROM t_sub_habilidades");

        while($sub_habilidad = mysqli_fetch_array($sub_habilidades)){

            if(isset($_POST[$sub_habilidad["id_sub_habilidad"]])){

                $existe = mysqli_query($con, "SELECT * FROM t_r_sub_habilidad_servicio WHERE id_servicio = '$_SESSION[id_tecnico]' AND id_sub_habilidad = '$sub_habilidad[id_sub_habilidad]'");

                if(mysqli_num_rows($existe) == false){

                    mysqli_query($con, "INSERT INTO t_r_sub_habilidad_servicio(id_servicio, id_sub_habilidad) VALUES('$_SESSION[id_tecnico]', '$sub_habilidad[id_sub_habilidad]')")

                }

            }

        }

        header("Location: perfil.php?id_usuario=". $_SESSION["id_usuario"] ."&id_rol=". $_SESSION["id_rol"]);

    }

?>

    <h1>Edita tus servicios</h1>

    <form action="edit_servicios.php" method="POST">

        <label for="perfil_tec">

            <span>Perfil técnico</span>

            <textarea name="perfil_tec" id="perfil_tec" value="<?=rellenar("perfil_tec")?>"></textarea>

        </label>

        <!-- UBICACIONES (REMOTO, FÍSICO, HÍBRIDO) -->
        <?php 

        $ubicaciones = mysqli_query($con, "SELECT * FROM t_ubicaciones");
        if(mysqli_num_rows($ubicaciones) > 0){

            ?><div><?php
                
                while($ubicacion = mysqli_fetch_array($ubicaciones)){ ?>

                <label for="<?=$ubicacion["id_ubicacion"]?>">

                    <input type="radio" name="ubicacion" value="<?=$ubicacion["id_ubicacion"]?>">

                    <span><?=$ubicacion["ubicacion"]?></span>

                </label>
                
                <?php }

            ?></div><?php

        } ?>

        <?php
        
        $habilidades = mysqli_query($con, "SELECT * FROM t_habilidades");

        if(mysqli_num_rows($habilidades) > 0){

            ?><ul><?php

                while($habilidad = mysqli_fetch_array($habilidades)){

                    ?><li><?=$habilidad["habilidad"]?></li><?php

                    $sub_habilidades = mysqli_query($con, "SELECT * FROM t_sub_habilidades WHERE id_habilidad = '$habilidad[id_habilidad]'");

                    if(mysqli_num_rows($sub_habilidades) > 0){

                        ?><ul><?php

                            while($sub_habilidad = mysqli_fetch_array($sub_habilidades)){

                                ?><li>

                                    <label for="<?=$sub_habilidad['id_sub_habilidad']?>">
        
                                        <input type="checkbox" name="<?=$sub_habilidad['id_sub_habilidad']?>" id="<?=$sub_habilidad['id_sub_habilidad']?>" value="<?=$sub_habilidad['id_sub_habilidad']?>">

                                        <span><?=$sub_habilidad["sub_habilidad"]?></span>

                                    </label>

                                </li><?php

                            }

                        ?></ul><?php

                    }

                }

            ?></ul><?php

        }

        ?>

        <button type="submit" name="btn_servicios" id="btn_servicios">Guardar cambios</button>

    </form>

<?php require_once "componentes/footer.php"; ?>