<?php

    // LA CONEXIÓN ESTÁ EN EL HEAD

    include("../componentes/head.php");

    ?>
        
        <a href="inicio.php">Postulantes</a>
    
        <a href="propuestas.php">Tus propuestas</a>
    
    <?php

    $id_empresa = $_SESSION["id_empresa"];

    $query = "SELECT * FROM t_propuestas WHERE id_empresa = '$id_empresa'";

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res)){

        ?>
        
            <main>

                <h3>Tus propuestas de trabajo</h3>
        
        <?php

        while($fila = mysqli_fetch_array($res)){

            ?>
            
                <div class="contenedor">

                    <div class="contenido">

                        <h4><?php echo $fila["titulo"]; ?></h4>

                        <p><?php echo $fila["descripcion"]; ?></p>

                        <p>Pago: <?php echo $fila["pago_min"]; ?></p>

                        <a href="">Editar</a>

                        <a href="">Eliminar</a>

                    </div>

                </div>
            
            <?php

        }

        ?>
        
            </main>
        
        <?php

    }

?>