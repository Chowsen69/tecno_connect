<?php

    class M_Servicio{

        private $con;

        public function construct__(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }

        public function insertar($id_servicio, $perfil_tec, $id_ubicacion){

            $accion = $this->con->prepare("INSERT INTO t_servicios(id_servicio, perfil_tec, id_ubicacion) VALUES(:id_servicio, :perfil_tec, :id_ubicacion)");

            $accion->bindParam(":id_servicio", $id_servicio);

            $accion->bindParam(":perfil_tec", $perfil_tec);

            $accion->bindParam(":id_ubicacion", $id_ubicacion);

            return ($accion->execute()) ? true : false;

        }

    }

?>