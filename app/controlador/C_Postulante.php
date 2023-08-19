<?php

    class C_Postulante{

        private $modelo;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Postulante.php";

            $this->modelo = new M_Postulante;

        }

        public function postularTecnico($id_tecnico, $id_propuesta){

            $id_postulacion = $this->modelo->insertar($id_tecnico, $id_propuesta);

            return ($id_postulacion != false) ? $id_postulacion : false;

        }

        public function despostularTecnico($id_tecnico, $id_propuesta){

            $res = $this->modelo->eliminar($id_tecnico, $id_propuesta);

            return $res;

        }

        public function estaPostulado($id_tecnico, $id_propuesta){

            $datos = $this->modelo->buscarPostulante($id_tecnico, $id_propuesta);

            return (empty($datos)) ? false : true;

        }

    }

?>