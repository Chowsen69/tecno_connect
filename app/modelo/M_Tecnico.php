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

        public function seleccionarTecnico($id_tecnico){

            $accion = $this->con->prepare("SELECT * FROM t_tecnicos 
            INNER JOIN t_usuarios 
                ON t_tecnicos.id_tecnico = t_usuarios.id_usuario 
            INNER JOIN t_especialidades 
                ON t_tecnicos.id_especialidad = t_especialidades.id_especialidad
            INNER JOIN t_tecnicas
                ON t_tecnicos.id_tecnica = t_tecnicas.id_tecnica 
            WHERE id_tecnico = :id_tecnico");

            $accion->bindParam(":id_tecnico", $id_tecnico);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function tecnicoTieneServicio($id_tecnico){

            // FUNCIÓN PARA PREGUNTAR SI UN TÉCNICO TIENE O NO AÑADIDO UN SERVICIO

            $accion = $this->con->prepare("SELECT * FROM t_servicios INNER JOIN t_ubicaciones ON t_servicios.id_ubicacion = t_ubicaciones.id_ubicacion WHERE id_servicio = :id_tecnico");

            $accion->bindParam(":id_tecnico", $id_tecnico);

            return ($accion->execute()) ? $accion->fetch() : false;

        }

        public function subHabilidadesDelTecnico($id_servicio){

            // FUNCIÓN QUE RETORNA LAS SUB-HABILIDADES QUE TIENE UN TÉCNICO

            $accion = $this->con->prepare("SELECT * FROM t_r_sub_habilidad_servicio INNER JOIN t_sub_habilidades ON t_r_sub_habilidad_servicio.id_sub_habilidad = t_sub_habilidades.id_sub_habilidad WHERE id_servicio = :id_servicio");

            $accion->bindParam(":id_servicio", $id_servicio);

            return ($accion->execute()) ? $accion->fetchAll() : false;

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