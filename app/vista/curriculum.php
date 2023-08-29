<?php 

require_once "componentes/head.php";

if(isset($_GET["id_servicio"])){

    ?><embed src="<?=URL_USUARIO . $_GET["id_servicio"] ."/curriculum/". $_GET["curriculum"]?>" type="application/pdf" width="100%" height="1000px"/><?php

    echo URL_USUARIO . $_GET["id_servicio"] ."/curriculum/". $_GET["curriculum"];

}else{

    // header("Location: ../../");

}


require_once "componentes/footer.php"; 

?>