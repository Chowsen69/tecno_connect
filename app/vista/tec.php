<?php 

require_once "componentes/head.php";

if($_SESSION["id_rol"] != 14){

    header("Location: ../../index.php");

}

?>

    <h1>Hola desde la vista de tecnico</h1>

<?php require_once "componentes/footer.php"; ?>