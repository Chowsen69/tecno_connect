<?php

    class C_Propuesta{

        private $modelo;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Propuesta.php";

            $this->modelo = new M_Propuesta();

        }

        public function generarPropuesta($id_empresa, $titulo, $descr, $pago_min, $limite){

            $id_propuesta = $this->modelo->insertar($id_empresa, $titulo, $descr, $pago_min, $limite);

            return ($id_propuesta != false) ? $id_propuesta : false;

        }

        public function siExisteLaPropuesta($id_empresa, $titulo, $descr, $pago_min, $limite){

            $existe = $this->modelo->buscarPropuesta($id_empresa, $titulo, $descr, $pago_min, $limite);

            if(empty($existe)){

                return false;

            }else{

                return true;

            }

        }

        public function mostrarPropuestas(){

            $filas = $this->modelo->traerPropuestas();

            ?>
            
            <h3>Propuestas de trabajo</h3>

            <ul>
                
            <?php

            foreach($filas as $fila){
    
                ?>
                
                <li>

                    <img src="<?= $fila["avatar"]; ?>" width="20px">

                    <a href="perfil.php?id_usuario=<?= $fila["id_usuario"]; ?>&id_rol=<?= $fila["id_rol"]; ?>"><?= $fila["nombre_empresa"]; ?></a>

                    <h3><?= $fila["titulo"]; ?></h3>

                    <p><?= $fila["descr"]; ?></p>

                    <div>

                        <span>- Pago: <?= $fila["pago_min"]; ?></span>

                        <span>- Límite: <?= $fila["limite"]; ?></span>

                        <?php if(isset($_SESSION["id_tecnico"])){

                            $se_postulo = $this->modelo->buscarPostulante($_SESSION["id_tecnico"], $fila["id_propuesta"]);

                            if(empty($se_postulo)){

                                ?><a href="../controlador/postular.php?id_propuesta=<?= $fila["id_propuesta"]; ?>">Postulate</a><?php

                            }else{

                                ?><a href="../controlador/postular.php?id_propuesta=<?= $fila["id_propuesta"]; ?>">Des-Postulate</a><?php

                            }
                            
                        } ?>


                    </div>

                </li>

                <?php

            }

            ?></ul><?php

        }

        public function mostrarPostulantes($id_empresa){

            $propuestas = $this->modelo->traerPropuestasEmpresa($id_empresa);

            if(!empty($propuestas)){

                ?>
                
                <h2>Técnicos postulados a tus propuestas de trabajo</h2>

                <ul>
                    
                <?php

                foreach($propuestas as $propuesta){

                    if(!empty($this->modelo->tienePostulantes($propuesta["id_propuesta"]))){

                        ?>

                        <li>
                            
                            <h3><?= $propuesta["titulo"]; ?></h3>

                            <p><?= $propuesta["descr"]; ?></p>

                            <div>

                                <span>- Pago: <?= $propuesta["pago_min"]; ?></span>

                                <span>- Límite: <?= $propuesta["limite"]; ?></span>

                            </div>

                            <h4>Postulantes</h4>

                            <ul>

                            <?php
                            
                                $postulantes = $this->modelo->recorrerPostulantes($propuesta["id_propuesta"]);

                                foreach($postulantes as $postulante){

                                    ?>
                                    
                                    <li>

                                        <img src="<?= $postulante["avatar"] ?>" width="20px">

                                        <a href="perfil.php?id_usuario=<?= $postulante["id_usuario"]; ?>&id_rol=<?= $postulante["id_rol"]; ?>"><?= $postulante["apellido"] . " " . $postulante["nombre"] ?></a>

                                    </li>
                                    
                                    <?php

                                }

                            ?>

                            </ul>

                        </li>

                        <?php

                    }

                }

            ?></ul><?php

            }

        }

        public function postularTecnico($id_tecnico, $id_propuesta){

            $resultado = $this->modelo->postularTecnico($id_tecnico, $id_propuesta);

            return $resultado;

        }

    }

?>