<?php

    class Bbdd{

        private $server = "Localhost";

        private $bbdd_nom = "tecno_connect";

        private $usuario = "root";

        private $contrasena = "";

        public function conexion(){

            try{

                $con = new PDO(

                    "mysql:host=". $this->server .";
                    
                    dbname=". $this->bbdd_nom,
                    
                    $this->usuario,

                    $this->contrasena);

                return $con;

            }catch(PDOException $e){

                return $e->getMessage();

            }

        }

    }

?>