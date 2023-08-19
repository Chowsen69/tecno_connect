<?php

    class M_Postulante{

        private $con;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }

        public function insertar($id_tecnico, $id_propuesta){

            $accion = $this->con->prepare("INSERT INTO t_postulantes(id_tecnico, id_propuesta) VALUES (:id_tecnico, :id_propuesta)");

            $accion->bindParam(":id_tecnico", $id_tecnico);

            $accion->bindParam(":id_propuesta", $id_propuesta);

            return ($accion->execute()) ? $this->con->lastInsertId() : false;

        }

        public function eliminar($id_tecnico, $id_propuesta){

            $accion = $this->con->prepare("DELETE FROM t_postulantes WHERE id_tecnico = :id_tecnico AND id_propuesta = :id_propuesta");

            $accion->bindParam(":id_tecnico", $id_tecnico);

            $accion->bindParam(":id_propuesta", $id_propuesta);

            return ($accion->execute()) ? true : false;

        }

        public function buscarPostulante($id_tecnico, $id_propuesta){

            $accion = $this->con->prepare("SELECT * FROM t_postulantes WHERE id_tecnico = :id_tecnico AND id_propuesta = :id_propuesta");

            $accion->bindParam(":id_tecnico", $id_tecnico);

            $accion->bindParam(":id_propuesta", $id_propuesta);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function traerPostulantes($id_empresa){

            $accion = $this->con->prepare("SELECT * FROM t_postulantes INNER JOIN t_tecnicos ON t_postulantes.id_tecnico = t_tecnicos.id_tecnico INNER JOIN t_propuestas ON t_postulantes.id_propuesta = t_propuestas.id_propuesta WHERE id_empresa = :id_empresa");

            $accion->bindParam(":id_empresa", $id_empresa);

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

    }

?>