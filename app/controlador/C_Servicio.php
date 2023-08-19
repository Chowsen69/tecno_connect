<?php

    class C_Servicio{

        private $m_servicio;

        private $m_habilidad;

        public function __construct(){

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Servicio.php";

            $this->m_servicio = new M_Servicio();

            require_once "C://xampp/htdocs/tecno_connect/app/modelo/M_Habilidad.php";

            $this->m_habilidad = new M_Habilidad();

        }

        public function listaSubHabilidades(){

            $habilidades = $this->m_habilidad->recorrerHabilidades();

            ?><ul><?php

            foreach($habilidades as $habilidad){

                $sub_habilidades = $this->m_habilidad->recorrerSubHabilidades($habilidad["id_habilidad"]);

                ?><li><?= $habilidad["habilidad"]; ?></li><?php

                ?><ul><?php

                foreach($sub_habilidades as $sub_habilidad){

                    ?>
                    
                    <li>
                    
                        <input type="checkbox" name="sub_habilidad" id="<?= $sub_habilidad["sub_habilidad"] ?>" value="<?= $sub_habilidad["id_sub_habilidad"]; ?>">
                    
                        <label for="<?= $sub_habilidad["sub_habilidad"] ?>"><?= $sub_habilidad["sub_habilidad"]; ?></label>
                        
                    </li>
                    
                    <?php

                }

                ?></ul><?php

            }

            ?></ul><?php

        }

    }

?>