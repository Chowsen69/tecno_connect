<?php

    include("../componentes/head.php");

    if(isset($_GET["id_empresa"])){

        $id_empresa = $_GET["id_empresa"];

        $query = "SELECT * FROM t_empresas WHERE id_empresa = '$id_empresa'";
        
        $res = mysqli_query($con, $query);

        if(mysqli_num_rows($res)){

            $fila = mysqli_fetch_array($res);

            ?>
            
                <img src="<?php echo $fila["portada"] ?>" width="90%" alt="Foto de portada"/>

                <img src="<?php echo $fila["avatar"] ?>" width="200px" alt="Foto de perfil"/>

                <h1><?php echo $fila["nombre_empresa"]; ?></h1>

                <a href="<?php echo $fila["sitio_web"]; ?>"><?php echo $fila["sitio_web"]; ?></a>

                <p><?php echo $fila["localidad"]; ?></p>

            <?php

        }

    }else{

        header("Location: inicio.php");

    }

?>