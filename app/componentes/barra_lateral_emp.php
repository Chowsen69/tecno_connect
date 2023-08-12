<div class="barra-lateral">

    <!-- BOTÓN MODAL -->
    <div class="div-btn-modal">

        <label for="btn_modal">Nueva propuesta</label>

    </div>
    <!-- FIN BOTÓN MODAL -->

    <h3>Filtros</h3>

    <p>Especialidad</p>

    <ul>

        <li><input type="checkbox">Programación</li>

        <li><input type="checkbox">Informática</li>

        <li><input type="checkbox">Alimentos</li>

    </ul>

</div>

    <!-- VENTANA MODAL -->
    <input type="checkbox" id="btn_modal">

    <div class="contenedor">

        <div class="contenido">

            <form action="../controlador/generar_propuesta.php" method="POST">

                <label for="titulo">

                    <span>Título</span>

                    <input type="text" name="titulo" id="titulo" required placeholder="Título descriptivo">

                </label>

                <label for="desc">

                    <span>Descripción</span>

                    <textarea type="text" name="desc" id="desc" rows="5" cols="50" placeholder="Describa brevemente cuál es la problemática que quiere resolver, los recursos necesarios, etc."></textarea>

                </label>

                <label for="pago_min">

                    <span>Pago mínimo</span>

                    <input type="text" name="pago_min" id="pago_min" placeholder="Precio en ARS / Negociable">

                </label>

                <input type="submit" name="btn_propuesta" id="btn_propuesta" hidden>

                <div class="div-btn-modal">

                    <label for="btn_modal">Cancelar</label>

                    <label for="btn_propuesta">Publicar</label>

                </div>

            </form>

        </div>

    </div>
    <!-- FIN VENTANA MODAL -->