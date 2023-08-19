<?php

    class M_Propuesta{

        private $con;

        public function __construct(){

            require "C://xampp/htdocs/tecno_connect/app/modelo/Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }

        public function insertar($id_empresa, $titulo, $descr, $pago_min, $limite){

            $accion = $this->con->prepare("INSERT INTO t_propuestas(id_empresa, titulo, descr, pago_min, limite, fecha_publicacion) VALUES(:id_empresa, :titulo, :descr, :pago_min, :limite, now())");

            $accion->bindParam(":id_empresa", $id_empresa);

            $accion->bindParam(":titulo", $titulo);

            $accion->bindParam(":descr", $descr);

            $accion->bindParam(":pago_min", $pago_min);

            $accion->bindParam(":limite", $limite);

            return ($accion->execute())? $this->con->lastInsertId() : false;

        }

        public function traerPropuestas(){  

            $accion = $this->con->prepare("SELECT * FROM t_propuestas INNER JOIN t_empresas ON t_propuestas.id_empresa = t_empresas.id_empresa INNER JOIN t_usuarios ON t_empresas.id_usuario = t_usuarios.id_usuario ORDER BY id_propuesta DESC");
            
            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

        public function traerPropuestasEmpresa($id_empresa){  

            $accion = $this->con->prepare("SELECT * FROM t_propuestas INNER JOIN t_empresas ON t_propuestas.id_empresa = t_empresas.id_empresa INNER JOIN t_usuarios ON t_empresas.id_usuario = t_usuarios.id_usuario WHERE t_propuestas.id_empresa = :id_empresa ORDER BY id_propuesta DESC");
            
            $accion->bindParam(":id_empresa", $id_empresa);

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

        public function buscarPropuesta($id_empresa, $titulo, $descr, $pago_min, $limite){

            $accion = $this->con->prepare("SELECT * FROM t_propuestas WHERE id_empresa = :id_empresa AND titulo = :titulo AND descr = :descr AND pago_min = :pago_min AND limite = :limite");

            $accion->bindParam(":id_empresa", $id_empresa);

            $accion->bindParam(":titulo", $titulo);

            $accion->bindParam(":descr", $descr);

            $accion->bindParam(":pago_min", $pago_min);

            $accion->bindParam(":limite", $limite);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function buscarPostulante($id_tecnico, $id_propuesta){

            $accion = $this->con->prepare("SELECT * FROM t_postulantes WHERE id_tecnico = :id_tecnico AND id_propuesta = :id_propuesta");

            $accion->bindParam(":id_tecnico", $id_tecnico);

            $accion->bindParam(":id_propuesta", $id_propuesta);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function tienePostulantes($id_propuesta){

            $accion = $this->con->prepare("SELECT * FROM t_postulantes WHERE id_propuesta = :id_propuesta");

            $accion->bindParam(":id_propuesta", $id_propuesta);

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

        public function recorrerPostulantes($id_propuesta){

            $accion = $this->con->prepare("SELECT * FROM t_postulantes INNER JOIN t_tecnicos ON t_postulantes.id_tecnico = t_tecnicos.id_tecnico INNER JOIN t_usuarios ON t_tecnicos.id_tecnico = t_usuarios.id_usuario WHERE id_propuesta = :id_propuesta");

            $accion->bindParam(":id_propuesta", $id_propuesta);

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

    }

?>