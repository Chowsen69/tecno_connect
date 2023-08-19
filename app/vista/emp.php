<?php 

require_once "componentes/head.php";

require_once "C://xampp/htdocs/tecno_connect/app/controlador/C_Propuesta.php";

$obj_propuesta = new C_Propuesta();

if(empty($_SESSION["id_empresa"])){

    header("Location: ../../index.php");

}

// GENERAR PROPUESTA
if(isset($_POST["btn_propuesta"])){

    $si_existe = $obj_propuesta->siExisteLaPropuesta($_SESSION["id_empresa"], $_POST["titulo"], $_POST["descr"], $_POST["pago_min"], $_POST["limite"]);

    if($si_existe == false){

        $id_propuesta = $obj_propuesta->generarPropuesta($_SESSION["id_empresa"], $_POST["titulo"], $_POST["descr"], $_POST["pago_min"], $_POST["limite"]);

        if($id_propuesta != false){

            echo "Se generó tu propuesta correctamente";

        }

    }

}

?>

    <h1>Vista de empresa</h1>

    <!-- FORMULARIO PARA GENERAR UNA PROPUESTA -->
    <form action="emp.php" method="POST">

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

    <?php $obj_propuesta->mostrarPostulantes($_SESSION["id_empresa"]); ?>

<?php require_once "componentes/footer.php"; ?>