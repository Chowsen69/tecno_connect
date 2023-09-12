<?php 

require_once "componentes/head.php";

if(isset($_GET["id_servicio"]) AND isset($_GET["curriculum"])){

    ?><embed src="<?=CURRICULUM . $_GET["curriculum"]?>" type="application/pdf" width="80%" height="1000px"/><?php

}else{

    header("Location: ../../");

}


require_once "componentes/footer.php"; 

?>