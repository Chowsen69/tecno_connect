<?php 

require_once "componentes/head.php";

if(empty($_SESSION["id_empresa"])){

    header("Location: ../../index.php");

}

?>

    <h1>Vista de empresa</h1>

    <!-- FORMULARIO PARA GENERAR UNA PROPUESTA -->
    <form action="../controlador/empresa/insertar_propuesta.php" method="POST">

        <h2>Generar nueva propuesta laboral</h2>

        <label for="titulo">

            <span>Título (*)</span>

            <input type="text" name="titulo" id="titulo" required autofocus>

        </label>

        <label for="descr">

            <span>Descripción</span>

            <textarea name="descr" id="descr" rows="1"></textarea>

        </label>

        <label for="pago_min">

            <span>Pago mínimo (*)</span>

            <input type="text" name="pago_min" id="pago_min" required>

        </label>

        <label for="limite">

            <span>Fecha límite (*)</span>

            <input type="date" name="limite" id="limite" required>

        </label>

        <button type="submit" name="btn_propuesta">Generar propuesta</button>

    </form>

    <?php $query = "SELECT * FROM t_propuestas INNER JOIN t_empresas ON t_propuestas.id_empresa = t_empresas.id_empresa INNER JOIN t_usuarios ON t_empresas.id_usuario = t_usuarios.id_usuario WHERE t_propuestas.id_empresa = '$_SESSION[id_empresa]'"; ?>

    <?php require_once ("../controlador/seleccionar_propuestas.php"); ?>

    <?php require_once ("../controlador/seleccionar_tecnicos.php"); ?>

<?php require_once "componentes/footer.php"; ?>