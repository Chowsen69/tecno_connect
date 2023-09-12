<?php

$query = "SELECT * FROM t_usuarios INNER JOIN t_tecnicos ON t_usuarios.id_usuario = t_tecnicos.id_tecnico INNER JOIN t_tecnicas ON t_tecnicos.id_tecnica = t_tecnicas.id_tecnica INNER JOIN t_especialidades ON t_tecnicos.id_especialidad = t_especialidades.id_especialidad";

$res = mysqli_query($con, $query);

if(mysqli_num_rows($res) > 0){

    ?><h2>Otros técnicos</h2><?php

    ?><ul><?php

    while($fila = mysqli_fetch_array($res)){

        ?>
        <li>
        
            <img src="<?=AVATAR . $fila["avatar"]?>" width="20px" alt="Foto de perfil">

            <a href="perfil.php?id_usuario=<?=$fila["id_usuario"]?>&id_rol=<?=$fila["id_rol"]?>"><?=$fila["nombre"] . " " . $fila["apellido"]?></a>

            <p><?=$fila["tecnica"] . " - " . $fila["especialidad"]?></p>

            <?php
            
            $servicio = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_servicios INNER JOIN t_ubicaciones ON t_servicios.id_ubicacion = t_ubicaciones.id_ubicacion WHERE id_servicio = '$fila[id_tecnico]'"));

            if(!empty($servicio)){

                ?><p><?=$servicio["perfil_tec"]?></p><?php

                if(!empty($servicio["curriculum"])){

                    ?><a href="curriculum.php?id_servicio=<?=$servicio["id_servicio"]?>&curriculum=<?=$servicio["curriculum"]?>" target="_blank">Ver currículum</a><?php

                }

            }

            ?>
        
        </li>
        <?php

    }

    ?></ul><?php

}

?>