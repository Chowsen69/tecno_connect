<?php

    class M_Habilidad{

        private $con;

        public function __construct(){

            require_once "Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }

        public function recorrerHabilidades(){

            $accion = $this->con->prepare("SELECT * FROM t_habilidades");

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

        public function recorrerSubHabilidades($id_habilidad){

            $accion = $this->con->prepare("SELECT * FROM t_sub_habilidades WHERE id_habilidad = :id_habilidad");

            $accion->bindParam(":id_habilidad", $id_habilidad);

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

    }

?>