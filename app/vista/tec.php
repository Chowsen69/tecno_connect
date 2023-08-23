<?php 

require_once "componentes/head.php";

require_once "../controlador/C_Propuesta.php";

$obj_inicio = new C_Propuesta();

if(empty($_SESSION["id_tecnico"])){

    header("Location: ../../index.php");

}

?>

    <h1>Vista de tecnico</h1>

<?php $obj_inicio->mostrarPropuestas(false); ?>

<?php require_once "componentes/footer.php"; ?>