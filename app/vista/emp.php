<?php 

require_once "componentes/head.php";

if($_SESSION["id_rol"] != 13){

    header("Location: ../../index.php");

}

?>

    <h1>Hola desde la vista de empresa</h1>

<?php require_once "componentes/footer.php"; ?>