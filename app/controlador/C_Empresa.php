<?php

    class C_Empresa{

        private $modelo;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Empresa.php";

            $this->modelo = new M_Empresa();

        }

        public function mostrarPerfilEmpresa($id_usuario){

            $empresa = $this->modelo->seleccionarEmpresa($id_usuario);

            ?>
            
            <img src="<?= $empresa["portada"]; ?>">

            <img src="<?= $empresa["avatar"]; ?>">

            <h1><?= $empresa["nombre_empresa"]; ?></h1>

            <!-- EDITAR PERFIL -->
            <?php if($id_usuario == $_SESSION["id_usuario"]){ ?><a href="edit_perfil.php">Editar perfil</a><?php } ?>

            <p><a href="<?= $empresa["sitio_web"] ?>" target="_blank"><?= $empresa["sitio_web"] ?></a></p>

            <p><?= $empresa["tamano"] ?></p>

            <p>Dedicada a: <?= $empresa["sector"]; ?><p>

            <p>Localidad: <?= $empresa["localidad"]; ?></p>

            <?php

        }

        public function guardarEmpresa($id_usuario, $nom_empr, $cuit, $localidad, $sitio_web, $sector, $id_tipo, $id_tamano){

            $id_empresa = $this->modelo->insertar($id_usuario, $nom_empr, $cuit, $localidad, $sitio_web, $sector, $id_tipo, $id_tamano);

            return ($id_empresa =! false) ? $id_empresa : false;

        }

        public function tiposEmpresas(){

            return ($this->modelo->traerTiposEmpresas()) ? $this->modelo->traerTiposEmpresas() : false;

        }

        public function tamanosEmpresas(){

            return ($this->modelo->traerTamanosEmpresas()) ? $this->modelo->traerTamanosEmpresas() : false;

        }

    }

?>