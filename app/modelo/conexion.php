<?php

    if($_SERVER["DOCUMENT_ROOT"] == "C:/xampp/htdocs"){

        $servidor = "localhost";

        $usuario = "root";

        $contrasena = "";

        $nom_bbdd = "tecno_connect";

    }else{

        $servidor = "localhost";

        $usuario = "u761283263_tecno_connect";

        $contrasena = "Tecnoconnect2023";

        $nom_bbdd = "u761283263_tecno_connect";

    }

    $con = mysqli_connect(

        $servidor,

        $usuario,

        $contrasena,

        $nom_bbdd

    );

?>