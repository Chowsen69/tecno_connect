<?php

    class C_Empresa{

        private $modelo;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Empresa.php";

            $this->modelo = new M_Empresa();

        }

        public function guardarEmpresa($id_usuario, $nom_empr, $cuit, $localidad, $sitio_web, $id_tipo, $id_tamano){

            $id_empresa = $this->modelo->insertar($id_usuario, $nom_empr, $cuit, $localidad, $sitio_web, $id_tipo, $id_tamano);

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