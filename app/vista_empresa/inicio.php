<?php

    // LA CONEXIÓN ESTÁ EN EL HEAD

    include("../componentes/head.php");

    ?>
        
        <a href="inicio.php">Postulantes</a>
    
        <a href="propuestas.php">Tus propuestas</a>
    
    <?php

    $id_empresa = $_SESSION["id_empresa"];

    $query = "SELECT * FROM t_postulantes INNER JOIN t_tecnicos ON t_postulantes.id_tecnico = t_tecnicos.id_tecnico INNER JOIN t_propuestas ON t_postulantes.id_propuesta = t_propuestas.id_propuesta WHERE id_empresa = '$id_empresa'";

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res)){

        ?>
        
            <main>

                <h3>Técnicos postulados a tus propuestas</h3>
        
        <?php

        while($fila = mysqli_fetch_array($res)){

            ?>
            
                <div class="contenedor">

                    <div class="contenido">

                        <img src="<?php echo $fila["avatar"]; ?>" width="20px"/>

                        <span><?php echo $fila["nombre"] ." ". $fila["apellido"]; ?></span>

                        <p><?php echo $fila["titulo"]; ?></p>

                    </div>

                </div>
            
            <?php

        }

        ?>
        
            </main>
        
        <?php

    }

    $query = "SELECT * FROM t_tecnicos INNER JOIN t_especialidades ON t_tecnicos.id_especialidad = t_especialidades.id_especialidad";

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res)){

        ?>
        
            <div>

                <h3>Otros técnicos</h3>
        
        <?php

        while($fila = mysqli_fetch_array($res)){

            ?>
            
                <div class="contenedor">

                    <div class="contenido">

                        <img src="<?php echo $fila["avatar"]; ?>" width="20px"/>

                        <span><?php echo $fila["nombre"] ." ". $fila["apellido"]; ?></span>

                        <p>Tecnico en <?php echo $fila["especialidad"]; ?></p>

                    </div>

                </div>
            
            <?php

        }

        ?>
        
            </div>
        
        <?php

    }

?>