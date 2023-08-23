<?php

    class C_Tecnico{

        private $modelo;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Tecnico.php";

            $this->modelo = new M_Tecnico();

        }
        
        public function mostrarPerfilTecnico($id_tecnico){

            $datos = $this->modelo->seleccionarTecnico($id_tecnico);

            ?>
            
            <img src="<?= $datos["portada"]; ?>">

            <img src="<?= $datos["avatar"]; ?>">

            <h1><?= $datos["nombre"] . " " . $datos["apellido"]; ?></h1>

            <!-- EDITAR PERFIL -->
            <?php if($id_tecnico == $_SESSION["id_tecnico"]){ ?><a href="edit_perfil.php">Editar perfil</a><?php } ?>

            <p>Tecnico/a en <?= $datos["especialidad"] ?> - <?= $datos["tecnica"] ?></p>

            <?php

            $servicio = $this->modelo->tecnicoTieneServicio($datos["id_tecnico"]);



            if(!empty($servicio)){

                ?>

                <h3>Perfil técnico</h3>
                
                <p><?= $servicio["perfil_tec"]; ?></p>

                <p>Mi forma de trabajo es en <?= $servicio["ubicacion"]; ?></p>

                <?php

                $sub_habilidades = $this->modelo->subHabilidadesDelTecnico($servicio["id_servicio"]);

                if(!empty($sub_habilidades)){

                    ?><h4>Habilidades</h4><?php

                    ?><ul><?php

                    foreach($sub_habilidades as $sub_habilidad){

                        ?><li><?= $sub_habilidad["sub_habilidad"]; ?></li><?php

                    }

                    ?></ul><?php

                }

            }else{

                ?><h3>No tiene servicios añadidos</h3><?php

                if($id_tecnico == $_SESSION["id_tecnico"]){ ?><p>No tienes servicios... <a href="edit_perfil.php">Añade tus servicios</a> para que las empresas puedan ver de qué eres capaz!</p><?php }

            }

        }

        public function guardarTecnico($id_usuario, $nombre, $apellido, $dni, $id_tecnica, $id_especialidad){

            $id_tecnico = $this->modelo->insertar($id_usuario, $nombre, $apellido, $dni, $id_tecnica, $id_especialidad);

            return ($id_tecnico =! false) ? $id_tecnico : false;

        }

        public function tecnicas(){

            return ($this->modelo->traerTecnicas()) ? $this->modelo->traerTecnicas() : false;

        }

        public function especialidades(){

            return ($this->modelo->traerEspecialidades()) ? $this->modelo->traerEspecialidades() : false;

        }

        public function validarDni($dni){

            $datos = $this->modelo->validarDni($dni);

            if(empty($datos)){

                return false;

            }else{

                return true;

            }

        }

    }

?>