<?php 

require_once "componentes/head.php";

?>

    <h1>Editar perfil</h1>

    <a href="perfil.php?id_usuario=<?= $_SESSION["id_usuario"] ?>&id_rol=<?= $_SESSION["id_rol"] ?>">Volver</a>

<?php require_once "componentes/footer.php"; ?>