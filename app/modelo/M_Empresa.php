<?php

    class M_Empresa{

        private $con;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }

        public function insertar($id_usuario, $nom_empr, $cuit, $localidad, $sitio_web, $sector, $id_tipo, $id_tamano){

            $accion = $this->con->prepare("INSERT INTO t_empresas(id_usuario, nombre_empresa, cuit, localidad, sitio_web, sector, id_tipo, id_tamano, fecha_creacion) VALUES(:id_usuario, :nom_empr, :cuit, :localidad, :sitio_web, :sector, :id_tipo, :id_tamano, now())");

            $accion->bindParam(":id_usuario", $id_usuario);

            $accion->bindParam(":nom_empr", $nom_empr);

            $accion->bindParam(":cuit", $cuit);

            $accion->bindParam(":localidad", $localidad);

            $accion->bindParam(":sitio_web", $sitio_web);

            $accion->bindParam(":sector", $sector);

            $accion->bindParam(":id_tipo", $id_tipo);

            $accion->bindParam(":id_tamano", $id_tamano);

            return ($accion->execute()) ? $this->con->lastInsertId() : false;

        }

        public function seleccionarEmpresa($id_usuario){

            $accion = $this->con->prepare("SELECT * FROM t_empresas 
            INNER JOIN t_usuarios
                ON t_empresas.id_usuario = t_usuarios.id_usuario
            INNER JOIN t_tipos
                ON t_empresas.id_tipo = t_tipos.id_tipo
            INNER JOIN t_tamanos
                ON t_empresas.id_tamano = t_tamanos.id_tamano
            WHERE t_empresas.id_usuario = :id_usuario");

            $accion->bindParam(":id_usuario", $id_usuario);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function traerPropuestasEmpresa($id_usuario){  

            $accion = $this->con->prepare("SELECT * FROM t_propuestas INNER JOIN t_empresas ON t_propuestas.id_empresa = t_empresas.id_empresa INNER JOIN t_usuarios ON t_empresas.id_usuario = t_usuarios.id_usuario WHERE t_propuestas.id_empresa = :id_usuario ORDER BY id_propuesta DESC");
            
            $accion->bindParam(":id_usuario", $id_usuario);

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

        public function traerTiposEmpresas(){

            $accion = $this->con->prepare("SELECT * FROM t_tipos");

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

        public function traerTamanosEmpresas(){

            $accion = $this->con->prepare("SELECT * FROM t_tamanos");

            return ($accion->execute()) ? $accion->fetchAll() : false;

        }

    }

?>