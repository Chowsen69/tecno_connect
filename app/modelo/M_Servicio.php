<?php

    class M_Servicio{

        private $con;

        public function construct__(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }

        public function insertar($id_servicio, $perfil_tec, $id_ubicacion, $pago_min){

            $accion = $this->con->prepare("INSERT INTO t_servicios(id_servicio, perfil_tec, id_ubicacion, pago_min) VALUES(:id_servicio, :perfil_tec, :id_ubicacion, :pago_min)");

            $accion->bindParam(":id_servicio", $id_servicio);

            $accion->bindParam(":perfil_tec", $perfil_tec);

            $accion->bindParam(":id_ubicacion", $id_ubicacion);

            $accion->bindParam(":pago_min", $pago_min);

            return ($accion->execute()) ? true : false;

        }

    }

?>