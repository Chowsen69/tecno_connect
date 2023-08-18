<?php

    class M_Tecnico{

        private $con;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }
        
        public function insertar($id_usuario, $nombre, $apellido, $dni, $id_tecnica, $id_especialidad){
            
            $accion = $this->con->prepare("INSERT INTO t_tecnicos(id_tecnico, nombre, apellido, dni, id_tecnica, id_especialidad, fecha_creacion) VALUES(:id_usuario, :nombre, :apellido, :dni, :id_tecnica, :id_especialidad, now())");

            $accion->bindParam(":id_usuario", $id_usuario);

            $accion->bindParam(":nombre", $nombre);

            $accion->bindParam(":apellido", $apellido);

            $accion->bindParam(":dni", $dni);

            $accion->bindParam(":id_tecnica", $id_tecnica);

            $accion->bindParam(":id_especialidad", $id_especialidad);

            return ($accion->execute()) ? $this->con->lastInsertId() : false;

        }

        public function traerTecnicas(){

            $accion = $this->con->prepare("SELECT * FROM t_tecnicas");

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

        public function traerEspecialidades(){

            $accion = $this->con->prepare("SELECT * FROM t_especialidades");

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

    }

?>