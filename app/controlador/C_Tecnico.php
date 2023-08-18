<?php

    class C_Tecnico{

        private $modelo;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Tecnico.php";

            $this->modelo = new M_Tecnico();

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