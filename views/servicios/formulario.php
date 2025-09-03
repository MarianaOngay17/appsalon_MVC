<div class="campo">
    <label for="nombre">Nombre</label>
    <input 
        type="text"
        id="nombre"
        placeholder="Nombre Servicio"
        name="nombre"
        value="<?php echo $servicios->nombre ?>"
    />
</div>

<div class="campo">
    <label for="precio">Precio</label>
    <input 
        type="number"
        id="precio"
        placeholder="Precio Servicio"
        name="precio"
        value="<?php echo $servicios->precio ?>"
    />
</div>