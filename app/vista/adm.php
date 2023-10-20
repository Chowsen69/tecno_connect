<?php 

require_once "componentes/head.php";

if($_SESSION["id_rol"] != 15){

    header("Location: ../../index.php");

}

?>

    <h1>Vista de administrador</h1>
    
    <!-- TABLA DE ADMINISTRADORES -->
    
    <h2>Tabla de administradores</h2>

    <?php
    
    $query = "SELECT * FROM t_usuarios INNER JOIN t_tecnicos ON t_usuarios.id_usuario = t_tecnicos.id_tecnico WHERE id_rol = '15'";

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res) > 0){
    
        ?>
        
        <table border="1px">
        
            <thead>
            
                <tr>
                
                    <th>#</th>
                    
                    <th>Gmail</th>
                    
                    <th>Nombre completo</th>
                    
                    <th>Dni</th>
                
                </tr>

            </thead>
        
            </tbody>

                <?php

                while($fila = mysqli_fetch_array($res)){
                    
                    ?>
                    <tr>
                    
                    <td><?= $fila["id_usuario"] ?></td>
                    
                    <td><?= $fila["gmail"] ?></td>
                    
                    <td><?= $fila["nombre"] . " " . $fila["apellido"] ?></td>
                    
                    <td><?= $fila["dni"] ?></td>
                    
                    <tr>
                    <?php

                }

                ?>
        
            </tbody>
        
        </table>

        <?php

    }

    ?>
    
    <!-- ACEPTAR CUENTAS -->
    
    <?php
    
    $query = "SELECT * FROM t_usuarios WHERE id_validacion = '1'";

    $res = mysqli_query($con, $query);

    if(mysqli_num_rows($res) > 0){
        
        ?><h2>Usuarios para validar</h2><?php
        
        ?><ul><?php

        while($fila = mysqli_fetch_array($res)){

            ?><li>
            
                <h3><?=$fila["gmail"]?></h3>

                <?php
                if($fila["id_rol"] == 14){
                
                    $tecnico = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_tecnicos INNER JOIN t_tecnicas ON t_tecnicos.id_tecnica = t_tecnicas.id_tecnica INNER JOIN t_especialidades ON t_tecnicos.id_especialidad = t_especialidades.id_especialidad WHERE id_tecnico = '$fila[id_usuario]'"));

                    if(!empty($tecnico)){
                    ?>
                    
                    <p><?=$tecnico["nombre"] ." ". $tecnico["apellido"]?></p>

                    <p><?=$tecnico["dni"]?></p>

                    <p><?=$tecnico["tecnica"] ." - ". $tecnico["especialidad"]?></p>

                    <?php
                    }else{

                        echo "Registro incompleto";

                    }

                }else{

                    $empresa = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_empresas INNER JOIN t_tipos ON t_empresas.id_tipo = t_tipos.id_tipo INNER JOIN t_tamanos ON t_empresas.id_tamano = t_tamanos.id_tamano WHERE id_usuario = '$fila[id_usuario]'"));

                    if(!empty($empresa)){
                    ?>
                    
                    <p><?=$empresa["nombre_empresa"]?></p>

                    <p><?=$empresa["cuit"]?></p>

                    <p><?=$empresa["localidad"]?></p>

                    <p><?=$empresa["sitio_web"]?></p>

                    <p><?=$empresa["sector"]?></p>

                    <p><?=$empresa["tipo"]?></p>

                    <p><?=$empresa["tamano"]?></p>

                    <?php
                    }else{

                        echo "Registro incompleto";

                    }

                }

                ?>
                
                <a href="../controlador/admin/rechazar_usuario.php?id_usuario=<?=$fila["id_usuario"]?>">Rechazar</a>

                <a href="../controlador/admin/aceptar_usuario.php?id_usuario=<?=$fila["id_usuario"]?>">Aceptar</a>
            
            </li><?php

        }

        ?></ul><?php
        
    }else{

        ?><h2>No hay usuarios para validar</h2><?php

    }

    ?>

<?php require_once "componentes/footer.php"; ?>