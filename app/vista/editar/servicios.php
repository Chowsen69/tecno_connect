<?php require_once "componentes/head.php";

    function perfilTec($atributo){

        include "../modelo/conexion.php";

        if(isset($_POST[$atributo])){

            echo $_POST[$atributo];

        }else{

            if(mysqli_num_rows(mysqli_query($con, "SELECT id_servicio FROM t_servicios WHERE id_servicio = '$_SESSION[id_tecnico]'"))){

            echo mysqli_fetch_array(mysqli_query($con, "SELECT $atributo FROM t_servicios WHERE id_servicio = '$_SESSION[id_tecnico]'"))[$atributo];

            }

        }

    }

    if(isset($_POST["btn_servicios"])){
        

        // CURRÍCULUM
        $url = $_SERVER["DOCUMENT_ROOT"] ."/tecno_connect/publico/usuarios/". $_SESSION["id_tecnico"] ."/";

        if(!file_exists($url)){

            mkdir($url);
    
        }
        if(!file_exists($url . "avatar/")){
    
            mkdir($url . "avatar/");
        
        }
        if(!file_exists($url . "portada/")){
    
            mkdir($url . "portada/");
            
        }
        if(!file_exists($url . "curriculum/")){
    
            mkdir($url . "curriculum/");
            
        }

        if($_FILES["curriculum"]["name"] == ""){

            // Si no seleccionó ningún currículum
            $curriculum = mysqli_fetch_array(mysqli_query($con, "SELECT curriculum FROM t_servicios WHERE id_servicio = '$_SESSION[id_tecnico]'"))["curriculum"];
            
        }else{
    
            $curriculum = uniqid() . $_FILES["curriculum"]["name"];
    
            move_uploaded_file($_FILES["curriculum"]["tmp_name"], $url . "curriculum/" . $curriculum);
    
        }

        // If para comprobar si el técnico ya tiene un servicio cargado
        if(mysqli_num_rows(mysqli_query($con, "SELECT id_servicio FROM t_servicios WHERE id_servicio = '$_SESSION[id_tecnico]'")) == 0){

            $insert = "INSERT INTO t_servicios(id_servicio, perfil_tec, curriculum, id_ubicacion) VALUES('$_SESSION[id_tecnico]', '$_POST[perfil_tec]', '$curriculum', '$_POST[ubicacion]')";

            if(mysqli_query($con, $insert)){

                echo "Se insertó correctamente";

            }

        }else{

            $update = "UPDATE t_servicios SET perfil_tec = '$_POST[perfil_tec]', id_ubicacion = '$_POST[ubicacion]', curriculum = '$curriculum' WHERE id_servicio = '$_SESSION[id_tecnico]'";

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

                    mysqli_query($con, "INSERT INTO t_r_sub_habilidad_servicio(id_servicio, id_sub_habilidad) VALUES('$_SESSION[id_tecnico]', '$sub_habilidad[id_sub_habilidad]')");

                }

            }else{

                $existe = mysqli_query($con, "SELECT * FROM t_r_sub_habilidad_servicio WHERE id_servicio = '$_SESSION[id_tecnico]' AND id_sub_habilidad = '$sub_habilidad[id_sub_habilidad]'");

                if(mysqli_num_rows($existe) == true AND $sub_habilidad["id_habilidad"] != 5){

                    mysqli_query($con, "DELETE FROM t_r_sub_habilidad_servicio WHERE id_servicio = '$_SESSION[id_tecnico]' AND id_sub_habilidad = '$sub_habilidad[id_sub_habilidad]'");

                }

            }
 
        }

        // Otra sub-habilidad
        if(!empty($_POST["otro"])){
            
            // id_habilidad = 5 <-- El id de la habilidad "otro" es igual a "5"
            $insert = mysqli_query($con, "INSERT INTO t_sub_habilidades(id_habilidad, sub_habilidad) VALUES('5', '$_POST[otro]')");
            
            if($insert){

                mysqli_query($con, "INSERT INTO t_r_sub_habilidad_servicio(id_servicio, id_sub_habilidad) VALUES('$_SESSION[id_tecnico]', ". mysqli_insert_id($con) .")");

            }
        }

        header("Location: perfil.php?id_usuario=". $_SESSION["id_usuario"] ."&id_rol=". $_SESSION["id_rol"]);

    }

?>

    <h2>Servicios</h2>

    <form action="edit_perfil.php" method="POST" enctype="multipart/form-data">

        <?php
        $servicios = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_servicios WHERE id_servicio = '$_SESSION[id_tecnico]'"));
        ?>

        <label for="perfil_tec">

            <span>Perfil técnico</span>

            <textarea name="perfil_tec" id="perfil_tec"><?=perfilTec("perfil_tec")?></textarea>

        </label>

        <label for="curriculum">

            <span>Currículum</span>

            <input type="file" name="curriculum" id="curriculum">

        </label>

        <!-- UBICACIONES (REMOTO, FÍSICO, HÍBRIDO) -->
        <?php 

        $ubicaciones = mysqli_query($con, "SELECT * FROM t_ubicaciones");
        if(mysqli_num_rows($ubicaciones) > 0){

            ?><div><?php
                
                while($ubicacion = mysqli_fetch_array($ubicaciones)){ ?>

                <label for="<?=$ubicacion["ubicacion"]?>">

                    <?php

                    if(!empty($servicios) AND $servicios["id_ubicacion"] == $ubicacion["id_ubicacion"]){

                        ?>
                        <input type="radio" name="ubicacion" id="<?=$ubicacion["ubicacion"]?>" value="<?=$ubicacion["id_ubicacion"]?>" required checked>
                        <?php

                    }else{

                        ?>
                        <input type="radio" name="ubicacion" id="<?=$ubicacion["ubicacion"]?>" value="<?=$ubicacion["id_ubicacion"]?>" required>
                        <?php

                    }

                    ?><span><?=$ubicacion["ubicacion"]?></span>

                </label>
                
                <?php }

            ?></div><?php

        } 
        
        ?>
        <!-- FIN - UBICACIONES -->

        <!-- LAS SUB-HABILIDADES DE LOS TÉCNICOS -->
        <?php
        $habilidades = mysqli_query($con, "SELECT * FROM t_habilidades");

        if(mysqli_num_rows($habilidades) > 0){

            ?><ul><?php

                // El id 5 es el que hace referencia a "otro", puedo dejar que se muestre, pero no me gusta
                while($habilidad = mysqli_fetch_array($habilidades) AND $habilidad["id_habilidad"] != 5){

                    ?><li><?=$habilidad["habilidad"]?></li><?php

                    $sub_habilidades = mysqli_query($con, "SELECT * FROM t_sub_habilidades WHERE id_habilidad = '$habilidad[id_habilidad]'");

                    if(mysqli_num_rows($sub_habilidades) > 0){

                        ?><ul><?php

                            while($sub_habilidad = mysqli_fetch_array($sub_habilidades)){

                                ?><li>

                                    <label for="<?=$sub_habilidad['id_sub_habilidad']?>">
        
                                        <?php
                                        // En caso de que tenga servicios, y ya tenga la sub-habilidad registrada en la tabla de relación para las sub-habilidades y los servicios
                                        if(!empty($servicios) AND mysqli_num_rows(mysqli_query($con, "SELECT * FROM t_r_sub_habilidad_servicio WHERE id_servicio = '$servicios[id_servicio]' AND id_sub_habilidad = '$sub_habilidad[id_sub_habilidad]'"))){

                                            ?>
                                            <input type="checkbox" name="<?=$sub_habilidad['id_sub_habilidad']?>" id="<?=$sub_habilidad['id_sub_habilidad']?>" value="<?=$sub_habilidad['id_sub_habilidad']?>" checked> 
                                            <?php
                                            
                                        }else{
                                            
                                            ?>
                                            <input type="checkbox" name="<?=$sub_habilidad['id_sub_habilidad']?>" id="<?=$sub_habilidad['id_sub_habilidad']?>" value="<?=$sub_habilidad['id_sub_habilidad']?>"> 
                                            <?php

                                        }
                                        ?>
                                            
                                        
                                           

                                        <span><?=$sub_habilidad["sub_habilidad"]?></span>

                                    </label>

                                </li><?php

                            }

                        ?></ul><?php

                    }

                }

            ?></ul><?php

        }

        // OTRA SUB-HABILIDAD
        ?>
        
        <ul>

            <li>Otro</li>

            <ul>

                <li>

                    <input type="text" name="otro" id="otro">

                </li>

            </ul>

        </ul>

        <?php

        ?>
        <!-- FIN - SUB-HABILIDADES -->

        <button type="submit" name="btn_servicios" id="btn_servicios">Guardar cambios</button>

    </form>

<?php require_once "componentes/footer.php"; ?>