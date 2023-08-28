<?php 

require_once "componentes/head.php";

// if(empty($_SESSION["id_tecnico"])){

//     header("Location: ../../index.php");

// }

?>

    <h1>Vista de tecnico</h1>

    <?php $query = "SELECT * FROM t_propuestas INNER JOIN t_empresas ON t_propuestas.id_empresa = t_empresas.id_empresa INNER JOIN t_usuarios ON t_empresas.id_usuario = t_usuarios.id_usuario"; ?>

    <?php require_once "../controlador/seleccionar_propuestas.php"; ?>

<?php require_once "componentes/footer.php"; ?>