<?php 

require_once "componentes/head.php";

if($_SESSION["id_rol"] != 15){

    header("Location: ../../index.php");

}

?>

    <h1>Hola desde la vista de administrador</h1>

<?php require_once "componentes/footer.php"; ?>