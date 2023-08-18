<?php

    class M_Usuario{

        private $con;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/Bbdd.php";

            $bbdd = new Bbdd();

            $this->con = $bbdd->conexion();

        }

        public function insertar($id_rol, $gmail, $clave, $avatar, $portada){
            
            $accion = $this->con->prepare("INSERT INTO t_usuarios(id_rol, gmail, contrasena, avatar, portada, fecha_creacion) VALUES (:id_rol, :gmail, :clave, :avatar, :portada, now())");

            $accion->bindParam(":id_rol", $id_rol);

            $accion->bindParam(":gmail", $gmail);

            $accion->bindParam(":clave", $clave);

            $accion->bindParam(":avatar", $avatar);

            $accion->bindParam(":portada", $portada);

            return ($accion->execute()) ? $this->con->lastInsertId() : false;

        }

        public function datosUsuario($id_usuario, $datos){

            $accion = $this->con->prepare("SELECT $datos FROM t_usuarios WHERE id_usuario = :id_usuario");

            $accion->bindParam(":id_usuario", $id_usuario);

            return ($accion->execute())? $accion->fetch() : false;

        }

        public function validarGmail($gmail){
            // FUNCION PARA VALIDAR SI EL GMAIL EXISTE O NO EN LA BASE DE DATOS
            $accion = $this->con->prepare("SELECT gmail FROM t_usuarios WHERE gmail = :gmail");

            $accion->bindParam(":gmail", $gmail);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function validarClave($gmail, $clave){
            // FUNCIÓN PARA VALIDAR SI LA CONTRASEÑA ES LA CORRECTA
            $accion = $this->con->prepare("SELECT id_usuario, gmail, contrasena FROM t_usuarios WHERE gmail = :gmail AND contrasena = :clave");

            $accion->bindParam(":gmail", $gmail);

            $accion->bindParam(":clave", $clave);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function buscarAdministrador($id_usuario){

            $accion = $this->con->prepare("SELECT * FROM t_usuarios WHERE id_usuario = :id_usuario AND id_rol = '15'");

            $accion->bindParam(":id_usuario", $id_usuario);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function buscarTecnico($id_usuario){

            $accion = $this->con->prepare("SELECT * FROM t_usuarios INNER JOIN t_tecnicos ON t_usuarios.id_usuario = t_tecnicos.id_tecnico WHERE id_usuario = :id_usuario");

            $accion->bindParam(":id_usuario", $id_usuario);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function buscarEmpresa($id_usuario){

            $accion = $this->con->prepare("SELECT * FROM t_usuarios INNER JOIN t_empresas ON t_usuarios.id_usuario = t_empresas.id_usuario WHERE t_usuarios.id_usuario = :id_usuario");

            $accion->bindParam(":id_usuario", $id_usuario);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

    }

?>