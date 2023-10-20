<?php

session_start();

if($_SESSION["id_rol"] != 15){
    
    header("Location: ../../vista/adm.php");

}

include("../../modelo/conexion.php");

if(isset($_POST["btn_admin_tec"])){
    
    mysqli_query($con, "UPDATE t_usuarios SET id_rol = '15' WHERE id_usuario = '$_GET[id_usuario]'");
    mysqli_query($con, "INSERT INTO t_tecnicos(id_tecnico, nombre, apellido, dni, id_tecnica, id_especialidad, fecha_creacion) VALUES('$_GET[id_usuario]', '$_POST[nombre]', '$_POST[apellido]', '$_POST[dni]', '$_POST[tecnica]', '$_POST[especialidad]', now())");
    
    header("Location: ../../vista/adm.php");

}else if(isset($_POST["btn_admin_emp"])){
    
    mysqli_query($con, "UPDATE t_usuarios SET id_rol = '15' WHERE id_usuario = '$_GET[id_usuario]'");
    mysqli_query($con, "INSERT INTO t_empresas(id_usuario, nombre_empresa, cuit, localidad, sitio_web, sector, id_tipo, id_tamano, fecha_creacion) VALUES ('$_GET[id_usuario]', '$_POST[nom_empr]', '$_POST[cuit]', '$_POST[localidad]', '$_POST[sitio_web]', '$_POST[sector]', '$_POST[tipo]', '$_POST[tamano]', now())");

    header("Location: ../../vista/adm.php");

}

if(isset($_GET["id_usuario"])){

    $res = mysqli_query($con, "SELECT * FROM t_usuarios WHERE id_usuario = '$_GET[id_usuario]'");
    
    $usuario = mysqli_fetch_array($res);
    
    if($usuario["id_rol"] == 13){
    
        $empresa = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_empresas WHERE id_usuario = '$usuario[id_usuario]'"));
        
        ?>
        <h1>Completar con datos de técnico</h1>

        <form action="hacer_usuario_admin.php?id_usuario=<?= $usuario["id_usuario"] ?>" method="POST">
            
        <label for="nombre">

                <span>Nombre (*)</span>

                <input type="text" name="nombre" id="nombre" autofocus required>
            
            </label>

            <label for="apellido">

                <span>Apellido (*)</span>

                <input type="text" name="apellido" id="apellido" required>

            </label>

            <label for="dni">

                <span>Número de documento (*)</span>

                <input type="text" name="dni" id="dni" required>

            </label>
            
            <label for="tecnica">

                <span>Técnica (*)</span>

                <select name="tecnica" id="tecnica" required>
                
                    <option value="" hidden>Seleccione la técnica</option>

                    <?php

                    $res = mysqli_query($con, "SELECT * FROM t_tecnicas");

                    while($fila = mysqli_fetch_array($res)){

                        ?><option value="<?= $fila["id_tecnica"] ?>"><?= $fila["tecnica"] ?></option><?php

                    }

                    ?>

                </select>

            </label>
            
            <label for="especialidad">

                <span>Especialidad (*)</span>

                <select name="especialidad" id="especialidad" required>
                
                    <option value="" hidden>Seleccione una especialidad</option>

                    <?php

                    $res = mysqli_query($con, "SELECT * FROM t_especialidades");

                    while($fila = mysqli_fetch_array($res)){

                        ?><option value="<?= $fila["id_especialidad"] ?>"><?= $fila["especialidad"] ?></option><?php

                    }

                    ?>

                </select>
            
            </label>
            
            <button type="submit" name="btn_admin_tec">Hacer administrador</button>
        
        </form>
        <?php

    }else{
    
        $tecnico = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM t_tecnicos WHERE id_tecnico = '$usuario[id_usuario]'"));
        
        ?>
        <h1>Completar con datos de empresa</h1>

        <form action="hacer_usuario_admin.php?id_usuario=<?= $usuario["id_usuario"] ?>" method="POST">
            
        <label for="nom_empr">
                
                <span>Nombre de la empresa (*)</span>
                
                <input type="text" name="nom_empr" id="nom_empr" required autofocus>

            </label>

            <label for="cuit">

                <span>Cuit (*)</span>

                <input type="text" name="cuit" id="cuit" required>

            </label>
            
            <label for="localidad">

                <span>Localidad (*)</span>

                <input type="text" name="localidad" id="localidad" required>

            </label>
            
            <label for="sitio_web">

                <span>Sitio web</span>

                <input type="url" name="sitio_web" id="sitio_web">

            </label>
            
            <label for="sector">

                <span>Sector (*)</span>

                <input type="text" name="sector" id="sector" required placeholder="A qué se dedica tu empresa">

            </label>
            
            <label for="tipo">

                <span>Tipo (*)</span>

                <select name="tipo" id="tipo" required>
                
                    <option value="" hidden>Seleccione el tipo</option>

                    <?php

                    $res = mysqli_query($con, "SELECT * FROM t_tipos");

                    while($fila = mysqli_fetch_array($res)){

                        ?><option value="<?=$fila["id_tipo"]?>"><?=$fila["tipo"]?></option><?php

                    }

                    ?>

                </select>

            </label>
            
            <label for="tamano">

                <span>Tamaño (*)</span>
                
                <select name="tamano" id="tamano" required>
                
                    <option value="" hidden>Seleccione el tamaño</option>
                    
                    <?php
                    
                    $res = mysqli_query($con, "SELECT * FROM t_tamanos");
                    
                    while($fila = mysqli_fetch_array($res)){
                        
                        ?><option value="<?=$fila["id_tamano"]?>"><?=$fila["tamano"]?></option><?php
                    
                    }

                    ?>

                </select>
            
            </label>

            <button type="submit" name="btn_admin_emp">Hacer administrador</button>
        
        </form>
        <?php

    }
}

?>