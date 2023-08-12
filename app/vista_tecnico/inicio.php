<?php

    // LA CONEXIÓN ESTÁ EN EL COMPONENTE HEAD

    include("../componentes/head.php");

    $query = "SELECT * FROM t_propuestas INNER JOIN t_empresas ON t_propuestas.id_empresa = t_empresas.id_empresa ORDER BY id_propuesta DESC";

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res)){

        $id_usuario = $_SESSION["id_usuario"];

        while($fila = mysqli_fetch_array($res)){

            $id_propuesta = $fila["id_propuesta"];

            ?>
            
                <div class="contenedor">

                    <div class="contenido">

                        <img src="../../publico/img/avatar/por_defecto.jpeg" width="20px"/>

                        <a href="perfil_emp.php?id_empresa=<?php echo $fila["id_empresa"]; ?>"><?php echo $fila["nombre_empresa"]; ?></a>

                        <h4><?php echo $fila["titulo"]; ?></h4>

                        <p><?php echo $fila["descripcion"]; ?></p>

                        <p>Pago: <?php echo $fila["pago_min"]; ?></p>
                        
                        <?php

                            $query = "SELECT * FROM t_postulantes WHERE id_tecnico = '$id_usuario' AND id_propuesta = '$id_propuesta'";

                            $res2 = mysqli_query($con, $query);

                            if(mysqli_num_rows($res2) == 0){

                                ?>

                                <a href="../controlador/postular_tec.php?id_propuesta=<?php echo $id_propuesta; ?>">Postulate</a>

                                <?php

                            }else{

                                ?>

                                <a href="../controlador/despostular_tec.php?id_propuesta=<?php echo $id_propuesta; ?>">Despostulate</a>

                                <?php

                            }

                        ?>

                    </div>

                </div>
            
            <?php

        }

    }

?>