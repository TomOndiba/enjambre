<?php
/**
 * Formulario que administra la informacion de un rubro de la bitacora 5.2
 * @author DIEGOX_CORTEX
 */
$bitacora = get_input("bitacora");
$input_hidden= elgg_view('input/hidden', array('name'=>'bitacora', 'value'=>$bitacora));
$url=  elgg_get_site_url().'ajax/view/bitacoras/bitacora5_2/guardar_rubro';
?>
<div id="form-crear-archivo">

    <h2 class="title-legend">Nuevo Rubro</h2>
 

    <div class="div-actividad">
        <label>Rubro:</label> <input type="text"  name="nombre" id="nombre-bit52" required="true" value="<?php echo $rubro->nombre; ?>">
        <label>Fecha del gasto:</label> <input type="date"  name="fecha_gasto" id="fechagasto-bit52" required="true" value="<?php echo $rubro->fecha_gasto; ?>">
        <label>Nombre del Proveedor:</label> <input type="text"  name="proveedor" id="proveedor-bit52" required="true" value="<?php echo $rubro->proveedor; ?>">
    </div>
    <div class="div-actividad">
        <label>Valor Unitario:</label> <input type="number"  name="valor_unitario" id="valorunitario-bit52" required="true" value="<?php echo $rubro->valor_unitario; ?>">
        <label>valor_total:</label> <input type="number"  name="valor_total"  id="valortotal-bit52" required="true" value="<?php echo $rubro->valor_total; ?>">
    </div>
    <?php echo $input_hidden;?>
    
    <input type="button" name="crear" value="Guardar Rubro" onclick="guardarRubro2(<?php echo $bitacora ?>)">
</div>

