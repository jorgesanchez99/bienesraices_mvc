<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php if($mensaje): ?>
         <p class='alerta exito'><?php echo $mensaje ;?></p>
    <?php endif; ?>
    <picture>
        <source srcset="build/img/destacada3.avif" type="image/avif">
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>

    <h2>LLene el formulario de contacto</h2>
    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" >

            

            

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" ></textarea>
        </fieldset>
        <fieldset>
            <legend>Información Sobre la propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select id="opciones" name="contacto[tipo]" >
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto" min="1" name="contacto[precio]" >
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Telefono</label>
                <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono" >

                <label for="contactar-email">E-mail</label>
                <input name="contacto[contacto]" type="radio" value="email" id="contactar-email" >
            </div>

            <div class="" id="contacto">

            </div>

            

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>