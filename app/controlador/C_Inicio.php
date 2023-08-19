<?php

    class C_Inicio{

        private $usuario;

        private $tecnico;

        private $empresa;

        private $propuesta;

        public function construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Usuario.php";

            $this->usuario = new M_Usuario();
            
            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Tecnico.php";

            $this->tecnico = new M_Tecnico();

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Empresa.php";

            $this->empresa = new M_Empresa();

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Propuesta.php";

            $this->propuesta = new M_Propuesta();

        }

        public function mostrarPropuestas(){

            // $filas = $this->propuesta->seleccionar();

            $this->propuesta->traerPropuestas();

            // foreach($filas as $fila){

            //     echo $fila["titulo"] ."<br>";

            // }

        }

    }

?>