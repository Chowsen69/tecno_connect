<?php require_once "componentes/head.php";

    if(isset($_GET["id_usuario"]) AND isset($_GET["id_rol"])){

        $usuario = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_usuarios WHERE id_usuario = '$_GET[id_usuario]'"));

        ?>
        
        <img src="<?=PORTADA . $usuario["portada"]?>" width="50%" alt="Foto de portada">

        <img src="<?=AVATAR . $usuario["avatar"]?>" alt="Foto de perfil">

        <?php

        switch ($_GET["id_rol"]) {

        case 15:
            
            // ADMINISTRADOR

            ?>
            
            <h1>Perfil de administrador</h1>

            <h2><?= $usuario["gmail"]; ?></h2>

            <?php if($_GET["id_usuario"] == $_SESSION["id_usuario"]){ ?><a href="edit_perfil.php">Editar perfil</a><?php } ?>

            <?php

            break;

        case 14:

            // TECNICO

            $tecnico = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_tecnicos INNER JOIN t_especialidades ON t_tecnicos.id_especialidad = t_especialidades.id_especialidad INNER JOIN t_tecnicas ON t_tecnicos.id_tecnica = t_tecnicas.id_tecnica WHERE id_tecnico = '$_GET[id_usuario]'"));

            ?>
            
            <h1><?=$tecnico["nombre"] . " " . $tecnico["apellido"]?></h1>

            <!-- EDITAR PERFIL -->
            <?php if($tecnico["id_tecnico"] == $_SESSION["id_usuario"]){ ?><a href="edit_perfil.php">Editar perfil</a><?php } ?>

            <p><?=$usuario["gmail"]?></p>

            <p><?=$tecnico["tecnica"]?> - Técnico/a en <?=$tecnico["especialidad"]?></p>

            <?php

            $servicio = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_servicios INNER JOIN t_ubicaciones ON t_servicios.id_ubicacion = t_ubicaciones.id_ubicacion WHERE id_servicio = '$tecnico[id_tecnico]'"));

            if(!empty($servicio)){

                ?>

                <h2>Servicios</h2>
                
                <p><?=$servicio["perfil_tec"]?></p>

                <p>Ubicacion: <?=$servicio["ubicacion"]?></p>

                <?php

                if(!empty($servicio["curriculum"])){

                    ?><a href="curriculum.php?id_servicio=<?=$servicio["id_servicio"]?>&curriculum=<?=$servicio["curriculum"]?>">Ver currículum</a><?php

                }

                $sub_habilidades = mysqli_query($con, "SELECT * FROM t_r_sub_habilidad_servicio INNER JOIN t_sub_habilidades ON t_r_sub_habilidad_servicio.id_sub_habilidad = t_sub_habilidades.id_sub_habilidad WHERE id_servicio = '$servicio[id_servicio]'");

                if(mysqli_num_rows($sub_habilidades) > 0){

                    ?><ul><?php

                        while($sub_habilidad = mysqli_fetch_array($sub_habilidades)){

                            ?>
                            
                            <li>
                                
                                <?=$sub_habilidad["sub_habilidad"]?>
                            
                                <!-- Si es tu perfil, añadir el eliminar -->
                                <?php if($servicio["id_servicio"] == $_SESSION["id_tecnico"]) { ?><a href="../controlador/tecnico/eliminar_sub_habilidad.php?id_sub_habilidad=<?=$sub_habilidad["id_sub_habilidad"]?>">Eliminar</a><?php } ?>

                            </li>
                            
                            <?php

                        }

                    ?></ul><?php

                }

            }else{

                ?><h2>No tiene servicios</h2><?php

                if($tecnico["id_tecnico"] == $_SESSION["id_usuario"]){ ?><p>No tienes servicios! <a href="edit_perfil.php">Añade tus servicios</a> para que las empresas vean de qué eres capaz ;)</p><?php }

            }

            break;

        case 13:

            // EMPRESA

            $empresa = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_empresas INNER JOIN t_tipos ON t_empresas.id_tipo = t_tipos.id_tipo INNER JOIN t_tamanos ON t_empresas.id_tamano = t_tamanos.id_tamano WHERE id_usuario = '$_GET[id_usuario]'"));

            ?>
            
            <h1><?=$empresa["nombre_empresa"] ?></h1>

            <!-- EDITAR PERFIL -->
            <?php if($empresa["id_usuario"] == $_SESSION["id_usuario"]){ ?><a href="edit_perfil.php">Editar perfil</a><?php } ?>

            <p><a href="<?=$empresa["sitio_web"]?>" target="_blank"><?=$empresa["sitio_web"]?></a></p>

            <p>Localidad: <?=$empresa["localidad"]?></p>

            <p>Tamaño: <?=$empresa["tamano"]?></p>

            <p>Tipo: <?=$empresa["tipo"]?></p>

            <p>Sector: <?=$empresa["sector"]?></p>

            <?php

            // PROPUESTAS DE LA EMPRESA
            $query = "SELECT * FROM t_propuestas INNER JOIN t_empresas ON t_propuestas.id_empresa = t_empresas.id_empresa INNER JOIN t_usuarios ON t_empresas.id_usuario = t_usuarios.id_usuario WHERE t_usuarios.id_usuario = '$_GET[id_usuario]'";
            
            require_once "../controlador/seleccionar_propuestas.php";

            break;

        default:

            header("Location: ../../");

            break;
        
        }

    }
    
    ?>

<?php require_once "componentes/footer.php"; ?>