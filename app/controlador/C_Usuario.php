<?php

    class C_Usuario{

        private $modelo;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Usuario.php";

            $this->modelo = new M_Usuario();

        }

        public function guardarUsuario($id_rol, $gmail, $clave){

            $avatar = "C://xampp/htdocs/tecno_connect/publico/img/avatar/por_defecto.png";

            $portada = "C://xampp/htdocs/tecno_connect/publico/img/portada/por_defecto.png";

            $id_usuario = $this->modelo->insertar($id_rol, $gmail, $clave, $avatar, $portada);

            return ($id_usuario != false)? $id_usuario : false;

        }

        public function validarGmail($gmail){

            $datos = $this->modelo->validarGmail($gmail);

            if(empty($datos)){

                return false;

            }else{

                return true;

            }

        }

        public function validarClave($gmail, $clave){

            $datos = $this->modelo->validarClave($gmail, $clave);

            if(empty($datos)){

                return false;

            }else{

                return $datos["id_usuario"];

            }

        }

        public function definirRol($id_usuario){

            $adm = $this->modelo->buscarAdministrador($id_usuario);

            $tec = $this->modelo->buscarTecnico($id_usuario);

            $emp = $this->modelo->buscarEmpresa($id_usuario);

            if(isset($adm["id_usuario"])){

                // ADMINISTRADOR
                return [1, $adm["id_rol"], $adm["id_usuario"]];

            }else if(isset($tec["id_tecnico"])){

                // TECNICO
                return [2, $tec["id_rol"], $tec["id_tecnico"]];

            }else{

                if(isset($emp["id_empresa"])){
    
                    // EMPRESA
                    return [3, $emp["id_rol"], $emp["id_usuario"], $emp["id_empresa"]];
    
                }else{

                    // REGISTRO INCOMPLETO
                    $datos = $this->modelo->datosUsuario($id_usuario, "*");
    
                    return [4, $datos["id_rol"], $datos["id_usuario"]];
    
                }

            }

        }

        public function cerrarSesion(){

            session_start();

            unset($_SESSION["id_usuario"]);

            unset($_SESSION["id_rol"]);

        }
    }

?>