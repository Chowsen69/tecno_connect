<?php require_once "componentes/head.php";

    if(isset($_GET["id_usuario"]) AND isset($_GET["id_rol"])){

        switch ($_GET["id_rol"]) {

        case 15:
            
            // ADMINISTRADOR

            require_once "../controlador/C_Usuario.php";

            $c_usuario = new C_Usuario();

            $c_usuario->mostrarPerfilAdmin($_GET["id_usuario"]);

            break;

        case 14:

            // TECNICO

            require_once "../controlador/C_Tecnico.php";

            $c_usuario = new C_Tecnico();

            $c_usuario->mostrarPerfilTecnico($_GET["id_usuario"]);

            break;

        case 13:

            // EMPRESA

            break;

        default:

            # code...

            break;
        
        }

    }
    ?>

<?php require_once "componentes/footer.php"; ?>